<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\Employee;
use App\Models\Mail\UserCreate;
use App\Models\User;
use App\Models\UserCompany;
use Auth;
use File;
use App\Models\Utility;
use App\Models\Acount;
use App\Models\Order;
use App\Models\Plan;
use App\Models\UserStore;
use App\Models\Store;
use App\Models\UserToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{

    public function index()
    {
        $user = \Auth::user();
        if(\Auth::user()->can('manage user'))
        {
            $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->get();

            return view('user.index')->with('users', $users);
        }
        else
        {
            return redirect()->back();
        }

    }

    public function create()
    {

        $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'user')->get();
        $user  = \Auth::user();
        $roles = Role::where('created_by', '=', $user->creatorId())->where('name','!=','client')->get()->pluck('name', 'id');
        $access          = Acount::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $store          = Store::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        if(\Auth::user()->can('create user'))
        {
            return view('user.create', compact('roles', 'customFields','access','store'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
       
    //     $usrAcounts =
    //         $request->acount_id;
    //    $acount_id = is_array($request->acount_id) ? implode(',', $request->acount_id) : $request->acount_id;
    //    $acounts=Utility::account($acount_id);
      
    //         foreach($acounts as $acount){
    //             $data[] = $acount->name;
    //             }
    //             $acount = implode(',', $data);
    $store_id = is_array($request->store_id) ? implode(',', $request->store_id) : $request->store_id;
        if(\Auth::user()->can('create user'))
        {
            $default_language = DB::table('settings')->select('value')->where('name', 'default_language')->first();
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required|max:120',
                                   'email' => 'required|email|unique:users',
                                   'password' => 'required|min:6',
                                   'role' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }


            $objUser    = \Auth::user();
            $role_r                = Role::findById($request->role);
            $acount               =Acount::find($request->acount_id);
          
            $psw                   = $request->password;
            // $request['acount_id'] = $acount_id;
            // $request['password']   = Hash::make($request->password);
            // $request['type']       = $role_r->name;
            // $request['lang']       = !empty($default_language) ? $default_language->value : 'en';
      
            // $request['created_by'] = \Auth::user()->creatorId();
            // $user = User::create($request->all());
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password   = Hash::make($request->password);
            $user->type      = $role_r->name;
            $user->acount_id = $request->acount_id;
            $user->acount = $acount->name;
            $user->store_id = $store_id;
            $user->lang    = !empty($default_language) ? $default_language->value : 'en';
      
            $user->created_by = \Auth::user()->creatorId();
            $user->save();
            $user->assignRole($role_r);
            if($request['type'] != 'client')
                \App\Models\Utility::employeeDetails($user->id,\Auth::user()->creatorId());

            $user->password = $psw;
            $user->type     = $role_r->name;
          
            try
            {
                Mail::to($user->email)->send(new UserCreate($user));
            }
            catch(\Exception $e)
            {

                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }
            if(!empty($request->store_id))
            {
                $stores   = array_filter($request->store_id);
                foreach($stores as $store)
                    {
                        UserStore::create(
                            [
                                'user_id' => $user->id,
                                'store_id' => $store,
                                
                            ]
                        );
                    }
            }

            return redirect()->route('users.index')->with('success', __('User successfully added.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));

        }
        else
        {
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $user  = \Auth::user();
        $roles = Role::where('created_by', '=', $user->creatorId())->where('name','!=','client')->get()->pluck('name', 'id');
        if(\Auth::user()->can('edit user'))
        {
            $user              = User::findOrFail($id);
            $user->customField = CustomField::getData($user, 'user');
            $customFields      = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'user')->get();
            $access          = Acount::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $store          = Store::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            return view('user.edit', compact('user', 'roles', 'customFields','access','store'));
        }
        else
        {
            return redirect()->back();
        }

    }


    public function update(Request $request, $id)
    {

        $store_id = is_array($request->store_id) ? implode(',', $request->store_id) : $request->store_id;
        if(\Auth::user()->can('edit user'))
        {
            if(\Auth::user()->type == 'company')
            {
                $user = User::findOrFail($id);
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required|max:120',
                                       'email' => 'required|email|unique:users,email,' . $id,
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $input = $request->all();
                $user->fill($input)->save();
                CustomField::saveData($user, $request->customField);

                return redirect()->route('users.index')->with(
                    'success', 'User successfully updated.'
                );
            }
            else
            {
                $user = User::findOrFail($id);
                $this->validate(
                    $request, [
                                'name' => 'required|max:120',
                                'email' => 'required|email|unique:users,email,' . $id,
                                'role' => 'required',
                            ]
                );

                $role          = Role::findById($request->role);
                $input         = $request->all();
                $input['type'] = $role->name;
                $user->store_id = $store_id;
                $user->fill($input)->save();
                Utility::employeeDetailsUpdate($user->id,\Auth::user()->creatorId());
                CustomField::saveData($user, $request->customField);

                $roles[] = $request->role;
                $user->roles()->sync($roles);
                if(!empty($request->store_id))
                {
                    $stores   = array_filter($request->store_id);
                    foreach($stores as $store)
                        {
                            UserStore::create(
                                [
                                    'user_id' => $user->id,
                                    'store_id' => $store,
                                    
                                ]
                            );
                        }
                }
                return redirect()->route('users.index')->with(
                    'success', 'User successfully updated.'
                );
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function show($id){
        $user  = User::find($id);
        return $user->products;
    }

    public function destroy($id)
    {


        if(\Auth::user()->can('delete user'))
        {
            $user = User::find($id);
            if($user)
            {
                if(\Auth::user()->type == 'company')
                {
                    if($user->delete_status == 0)
                    {
                        $user->delete_status = 1;
                    }
                    else
                    {
                        $user->delete_status = 0;
                    }
                    $user->save();
                }
                if(\Auth::user()->type == 'company')
                {
                    $employee = Employee::where(['user_id' => $user->id])->delete();
                    if($employee){
                        $delete_user = User::where(['id' => $user->id])->delete();
                        if($delete_user){
                            return redirect()->route('users.index')->with('success', __('User successfully deleted .'));
                        }else{
                            return redirect()->back()->with('error', __('Something is wrong.'));
                        }
                    }else{
                        return redirect()->back()->with('error', __('Something is wrong.'));
                    }
                }

                return redirect()->route('users.index')->with('success', __('User successfully deleted .'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function profile()
    {
        $userDetail              = \Auth::user();
        $userDetail->customField = CustomField::getData($userDetail, 'user');
        $customFields            = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'user')->get();

        return view('user.profile', compact('userDetail', 'customFields'));
    }

    public function editprofile(Request $request)
    {

        $userDetail = \Auth::user();
        $user       = User::findOrFail($userDetail['id']);
        $this->validate(
            $request, [
                        'name' => 'required|max:120',
                        'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                    ]
        );
        if($request->hasFile('profile'))
        {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir        = storage_path('uploads/avatar/');
            $image_path = $dir . $userDetail['avatar'];

            if(File::exists($image_path))
            {
                File::delete($image_path);
            }

            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }


        }

        if(!empty($request->profile))
        {
            $user['avatar'] = $fileNameToStore;
        }
        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
        $user->save();
        CustomField::saveData($user, $request->customField);

        return redirect()->route('dashboard')->with(
            'success', 'Profile successfully updated.'
        );
    }

    public function updatePassword(Request $request)
    {

        if(Auth::Check())
        {
            $request->validate(
                [
                    'old_password' => 'required',
                    'password' => 'required|min:6',
                    'password_confirmation' => 'required|same:password',
                ]
            );
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            if(Hash::check($request_data['old_password'], $current_password))
            {
                $user_id            = Auth::User()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();

                return redirect()->route('profile', $objUser->id)->with('success', __('Password successfully updated.'));
            }
            else
            {
                return redirect()->route('profile', $objUser->id)->with('error', __('Please enter correct current password.'));
            }
        }
        else
        {
            return redirect()->route('profile', \Auth::user()->id)->with('error', __('Something is wrong.'));
        }
    }
    // User To do module
    public function todo_store(Request $request)
    {
        $request->validate(
            ['title' => 'required|max:120']
        );

        $post            = $request->all();
        $post['user_id'] = Auth::user()->id;
        $todo            = UserToDo::create($post);


        $todo->updateUrl = route(
            'todo.update', [
                             $todo->id,
                         ]
        );
        $todo->deleteUrl = route(
            'todo.destroy', [
                              $todo->id,
                          ]
        );

        return $todo->toJson();
    }

    public function todo_update($todo_id)
    {
        $user_todo = UserToDo::find($todo_id);
        if($user_todo->is_complete == 0)
        {
            $user_todo->is_complete = 1;
        }
        else
        {
            $user_todo->is_complete = 0;
        }
        $user_todo->save();
        return $user_todo->toJson();
    }

    public function todo_destroy($id)
    {
        $todo = UserToDo::find($id);
        $todo->delete();

        return true;
    }

    // change mode 'dark or light'
    public function changeMode()
    {
        $usr = Auth::user();
        if($usr->mode == 'light')
        {
            $usr->mode      = 'dark';
            $usr->dark_mode = 1;
        }
        else
        {
            $usr->mode      = 'light';
            $usr->dark_mode = 0;
        }
        $usr->save();

        return redirect()->back();
    }

    public function upgradePlan($user_id)
    {
        $user = User::find($user_id);

        $plans = Plan::get();

        return view('user.plan', compact('user', 'plans'));
    }
    public function activePlan($user_id, $plan_id)
    {

        $user       = User::find($user_id);
        $assignPlan = $user->assignPlan($plan_id);
        $plan       = Plan::find($plan_id);
        if($assignPlan['is_success'] == true && !empty($plan))
        {
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            Order::create(
                [
                    'order_id' => $orderID,
                    'name' => null,
                    'card_number' => null,
                    'card_exp_month' => null,
                    'card_exp_year' => null,
                    'plan_name' => $plan->name,
                    'plan_id' => $plan->id,
                    'price' => $plan->price,
                    'price_currency' => isset(\Auth::user()->planPrice()['currency']) ? \Auth::user()->planPrice()['currency'] : '',
                    'txn_id' => '',
                    'payment_status' => 'succeeded',
                    'receipt' => null,
                    'user_id' => $user->id,
                ]
            );

            return redirect()->back()->with('success', 'Plan successfully upgraded.');
        }
        else
        {
            return redirect()->back()->with('error', 'Plan fail to upgrade.');
        }

    }

    public function userPassword($id)
    {
        $eId        = \Crypt::decrypt($id);
        $user = User::find($eId);

        return view('user.reset', compact('user'));

    }

    public function userPasswordReset(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'password' => 'required|confirmed|same:password_confirmation',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }


        $user                 = User::where('id', $id)->first();
        $user->forceFill([
                             'password' => Hash::make($request->password),
                         ])->save();

        return redirect()->route('users.index')->with(
            'success', 'User Password successfully updated.'
        );


    }

}
