<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Exports\ProductServiceExport;
use App\Imports\ProductServiceImport;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use App\Models\InvoiceProduct;
use App\Models\ProductServiceUnit;
use App\Models\UserProduct;
use App\Models\User;
use App\Models\Store;
use App\Models\ProductStore;
use App\Models\Acount;
use Illuminate\Support\Arr;
use App\Models\Tax;
use App\Models\Threepl;
use App\Models\Utility;
use App\Models\Warehouse;
use App\Models\Vender;
use App\Models\ProductThpl;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



class ProductServiceController extends Controller
{
    public function index(Request $request)
    {

        if(\Auth::user()->can('manage product & service'))
        {
            $category = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 0)->get()->pluck('name', 'id');
            $category->prepend('Select Category', '');
                if(!empty($request->category))
                {

                    $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->where('category_id', $request->category)->get();
                }
                else
                {
                    $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get();
                } 
            return view('productservice.index', compact('productServices', 'category'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

      public function indextype($type)
        {
            if(\Auth::user()->can('manage product & service'))
            {
                if(\Auth::user()->type == 'Intern'){
                    $user = \Auth::user(); 
                    $productServices =  $user->products;
                }else{
                $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->where('type', $type)->get();
                }
                return view('productservice.indextwo', compact('productServices'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }

    public function create()
    {
       
        if(\Auth::user()->can('create product & service'))
        {
            $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'product')->get();
            $category     = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 0)->get()->pluck('name', 'id');
            $unit         = ProductServiceUnit::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $tax          = Tax::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('productservice.create', compact('category', 'unit', 'tax', 'customFields'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function show($id){
         $productService = ProductService::find($id);
         return view('productservice.show', compact('productService'));
    }

    public function store(Request $request)
    {
   
        if(\Auth::user()->can('create product & service'))
        {
           
            $rules = [
                'name' => 'required',
                'sku' => 'required|unique:product_services,sku',
                'sale_price' => 'required|numeric',
                'purchase_price' => 'required|numeric',
            ];

            $validator = \Validator::make($request->all(), $rules);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('productservice.index')->with('error', $messages->first());
            }

            $productService                 = new ProductService();
            $productService->name           = $request->name;
            $productService->description    = $request->description;
            $productService->sku            = $request->sku;
            $productService->sale_price     = $request->sale_price;
            $productService->purchase_price = $request->purchase_price;
            $productService->tax_id         = $request->tax_id;
            $productService->unit_id        = $request->unit_id;
            $productService->quantity        = $request->quantity;
            $productService->type           = $request->prodtype;
            $productService->date           = $request->date;
            $productService->asin           = $request->asin;
            $productService->amzlink      = $request->amzlink;
            $productService->sourcelink      = $request->sourcelink;
            $productService->reflink      = $request->reflink;
            $productService->asourceprice      = $request->asourceprice;
            $productService->sourceprice      = $request->sourceprice;
            $productService->sourcepack         = $request->sourcepack;
            $productService->selpack         = $request->selpack;
            $productService->shipping         = $request->shipping;
            $productService->totalcostin         = $request->totalcostin;
            $productService->totalcost         = $request->totalcost;
            $productService->bundlecost         = $request->bundlecost;
            $productService->fbafee         = $request->fbafee;
            $productService->reffee         = $request->reffee;
            $productService->amzship         = $request->amzship;
            $productService->thpl            = $request->thpl;
            $productService->profit         = $request->profit;
            $productService->costexl         = $request->costexl;
            $productService->costexlfb       = $request->costexlfb;
            $productService->totlrev         = $request->totlrev;
            $productService->netprofit         = $request->netprofit;
            $productService->orderval         = $request->orderval;
            $productService->roi              = $request->roi;
            $productService->created_by     = \Auth::user()->creatorId();
            $productService->save();
            CustomField::saveData($productService, $request->customField);
                 $amz = ProductService::where('amzlink' ,$request->amzlink)->get();
            if($amz){
                return redirect()->route('productservice.index')->with('error',__('amz link already exists.'));
            }else{
                return redirect()->route('productservice.index')->with('success', __('Product successfully created.'));
            }

            return redirect()->route('productservice.index')->with('success', __('Product successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function edit($id)
    {
        $productService = ProductService::find($id);
        return $productService->stores->name;

        if(\Auth::user()->can('edit product & service'))
        {
            if($productService->created_by == \Auth::user()->creatorId())
            {
                
                $productService->customField = CustomField::getData($productService, 'product');
                $customFields                = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'product')->get();
      

                return view('productservice.edit', compact('productService', 'customFields'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function update(Request $request, $id)
    {

        if(\Auth::user()->can('edit product & service'))
        {
            $productService = ProductService::find($id);
            if($productService->created_by == \Auth::user()->creatorId())
            {

                $rules = [
                    'name' => 'required',
                    'sku' => 'required|unique:product_services,sku',
                    'sale_price' => 'required|numeric',
                    'purchase_price' => 'required|numeric',
                    'category_id' => 'required',
                    'unit_id' => 'required',
                    'type' => 'required',
                ];

                $validator = \Validator::make($request->all(), $rules);

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('productservice.index')->with('error', $messages->first());
                }

                $productService->name           = $request->name;
                $productService->description    = $request->description;
                $productService->sku            = $request->sku;
                $productService->sale_price     = $request->sale_price;
                $productService->purchase_price = $request->purchase_price;
                $productService->tax_id         = $request->tax_id;
                $productService->unit_id        = $request->unit_id;
                $productService->quantity        = $request->quantity; 
                 $productService->type           = "product";
                $productService->date           = $request->date;
                $productService->asin           = $request->asin;
                $productService->amzlink      = $request->amzlink;
                $productService->sourcelink      = $request->sourcelink;
                $productService->asourceprice      = $request->asourceprice;
                $productService->sourceprice      = $request->sourceprice;
                $productService->sourcepack         = $request->sourcepack;
                $productService->selpack         = $request->selpack;
                $productService->shipping         = $request->shipping;
                $productService->totalcostin         = $request->totalcostin;
                $productService->totalcost         = $request->totalcost;
                $productService->bundlecost         = $request->bundlecost;
                $productService->fbafee         = $request->fbafee;
                $productService->reffee         = $request->reffee;
                $productService->amzship         = $request->amzship;
                $productService->thpl            = $request->thpl;
                $productService->profit         = $request->profit;
                $productService->costexl         = $request->costexl;
                $productService->costexlfb       = $request->costexlfb;
                $productService->totlrev         = $request->totlrev;
                $productService->netprofit         = $request->netprofit;
                $productService->orderval         = $request->orderval;
                $productService->roi              = $request->roi;
                $productService->created_by     = \Auth::user()->creatorId();
                $productService->update();
                CustomField::saveData($productService, $request->customField);

                return redirect()->route('productservice.index')->with('success', __('Product successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function storeEdit($id)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            $user = \Auth::user();
            $productService = ProductService::find($id);
                $stores = $user->stores->pluck('name', 'id');
                return view('productservice.stores', compact('productService', 'stores'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }
    public function storeUpdate($id, Request $request)
    {
      
        $userid = \Auth::user()->id;
        if(\Auth::user()->can('edit product & service'))
        {
                 $usr  = \Auth::user();
                 $productService = ProductService::find($id);
                if(!empty($request->stores))
                {
                    $stores   = array_filter($request->stores);
                    $ProdArr = [
                        'product_id' => $productService->id,
                        'name' => $productService->name,
                        'updated_by' => $usr->id,
                    ];

                    foreach($stores as $store)
                    {

                        ProductStore::create(
                            [
                                'user_id' => $userid,
                                'product_id' => $productService->id,
                                'store_id' => $store,
                            ]
                        );
                    }
                }

                if(!empty($stores) && !empty($request->stores))
                {
                    return redirect()->back()->with('success', __('Users successfully updated!'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Please Select Valid User!'));
                }
          
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function prodreturn($id){
        $subTotal = 0;
     $product = ProductService::find($id);
      if($product->invoice == 'invoiced'){
        $invoiceprods = InvoiceProduct::where('product_id',$id)->get();
        foreach($invoiceprods as $invoiceprod){
             $subTotal = ($invoiceprod->price * $invoiceprod->quantity) + ($invoiceprod->boxcost * $invoiceprod->boxno);
            $store =  $invoiceprod->store();
           $storeblnce  =  $store->blnce + $subTotal;
           $store->blnce = $storeblnce;
            $store->returnblnce = $subTotal;
            $store->update();
            $product->returned = 'returned';
            $update = $product->update();
        }
        if($update)
        {
            return redirect()->back()->with('success', __('Product successfully returned!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Please Select Valid User!'));
        }
     }else{
        $product->returned = 'returned';
        $update = $product->update();
        if($update)
        {
            return redirect()->back()->with('success', __('Product successfully returned!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Please Select Valid User!'));
        }
     }
   
   

    }


    public function productreturn($type){
        if(!empty($type)){
        $productServices = ProductService::where('status','approve')->where('returned','returned')->where('recived','recieved')->where('type',$type)->get(); 
        }else{
            $productServices = ProductService::where('status','approve')->where('purchase','purchased')->where('recived','recieved')->get();;
        }
     
            return view('productservice.return', compact('productServices'));
       
    }
    public function userEdit($id)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            $productService = ProductService::find($id);

            if(\Auth::user()->type == "company")
            {
                $users = User::where('created_by', '=', \Auth::user()->creatorId())->whereNOTIn(
                    'id', function ($q) use ($productService){
                    $q->select('user_id')->from('user_products')->where('product_id', '=', $productService->id);
                }
                )->get();
            }
            else
            {
                if($productService->type == "Amazon"){
                    $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('acount', 'Amazon')->where('type', '!=', 'company')->whereNOTIn(
                        'id', function ($q) use ($productService){
                        $q->select('user_id')->from('user_products')->where('product_id', '=', $productService->id);
                    }
                    )->get();
                }else{
                    $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('acount', 'Walmart')->where('type', '!=', 'company')->whereNOTIn(
                        'id', function ($q) use ($productService){
                        $q->select('user_id')->from('user_products')->where('product_id', '=', $productService->id);
                    }
                    )->get();
                }
                $users = $users->pluck('name', 'id');

                return view('productservice.users', compact('productService', 'users'));
            }
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function userUpdate($id, Request $request)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            $usr  = \Auth::user();
            $productService = ProductService::find($id);

            if($productService->created_by == $usr->creatorId())
            {
                if(!empty($request->users))
                {
                    $users   = array_filter($request->users);
                    $ProdArr = [
                        'product_id' => $productService->id,
                        'name' => $productService->name,
                        'updated_by' => $usr->id,
                    ];

                    foreach($users as $user)
                    {
                        UserProduct::create(
                            [
                                'product_id' => $productService->id,
                                'user_id' => $user,
                            ]
                        );
                    }
                }

                if(!empty($users) && !empty($request->users))
                {
                    return redirect()->back()->with('success', __('Users successfully updated!'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Please Select Valid User!'));
                }
            }
            else
            {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function statusedit($id){
        if(\Auth::user()->can('edit product & service'))
        {
            $productService = ProductService::find($id);
            return view('productservice.editstatus', compact('productService'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function purchasedit($id){
     
        if(\Auth::user()->can('edit product & service'))
        {
            if(\Auth::user()->type == "company" || \Auth::user()->type == "Admin")
            {
                $productService = ProductService::find($id);
                return view('productservice.editpurchase', compact('productService'));
            }else{
                $productService = ProductService::find($id);
                return view('productservice.editpurchase', compact('productService'));
            } 
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function deliveredit($id){
        if(\Auth::user()->can('edit product & service'))
        {
            if(\Auth::user()->type == "company" || \Auth::user()->type == "Admin")
            {
                $acount = Acount::all()->pluck('name', 'id');
            
                $productService = ProductService::find($id);
                $warehouse  = Warehouse::get()->pluck('name', 'id');
                return view('productservice.editdelivery', compact('productService','acount','warehouse'));
            }else{
                $acount_id =  \Auth::user()->acount_id;
                $acounts=Utility::account($acount_id);
                $acount = Arr::pluck($acounts, 'name','id');
                $productService = ProductService::find($id);
                $warehouse  = Warehouse::get()->pluck('name', 'id');
                return view('productservice.editdelivery', compact('productService','acount','warehouse'));
            } 
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function dimenedit($id){
     
        if(\Auth::user()->can('edit product & service'))
        {
            if(\Auth::user()->type == "company" || \Auth::user()->type == "Admin")
            {
                // $thpl = Threepl::all()->pluck('size', 'id');
                $thpl = Threepl::select(\DB::raw('CONCAT(boxcost, " - ", size) AS code_name, id'))->get()->pluck('code_name', 'id');
                $thpl->prepend('--', '');
                $productService = ProductService::find($id);
                return view('productservice.editdimen', compact('productService','thpl'));
            }else{
                $thpl = Threepl::all()->pluck('size', 'id');
                $productService = ProductService::find($id);
                return view('productservice.editdimen', compact('productService','thpl'));
            } 
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function statusupdate(Request $request, $id){
        
        $productService = ProductService::find($id);
        $productService->status = $request->status;
        $update = $productService->update();
        if($update){
            return redirect()->route('productservice.index')->with('success', __('Product successfully updated.'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
        public function labeledit($id){
        if(\Auth::user()->can('edit product & service'))
        {
            $productServices = ProductService::find($id);
            $productService = $productServices->threepls;
            return view('productservice.editlabel', compact('productService' ,'productServices'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    
    
     public function labelupdate(Request $request,$id){
       
        $boxdimens = $request->boxdimens;
        $productServices = ProductThpl::where('product',$id)->get();
        foreach($productServices as $productService){
          
            $productService->carlabel = $request->carlabel;
            $fileName = time() . "_" . $request->carlabel->getClientOriginalName();
            $path =    $request->carlabel->storeAs('uploads/carlabel', $fileName);
           $productService->carlabel = $fileName;
           $productService->carlabel_url = $path;

           $productService->recvlabel = $request->recvlabel;
           $fileName = time() . "_" . $request->recvlabel->getClientOriginalName();
           $path =    $request->recvlabel->storeAs('uploads/recvlabel', $fileName);
          $productService->recvlabel = $fileName;
          $productService->recvlabel_url = $path;
          $update = $productService->update();
        }
          if($update){
            $prod = ProductService::find($id);
            $prod->shipped = "shipped";
            $updatepro = $prod->update();
            if($updatepro){
              return redirect()->back()->with('success', __('Product successfully updated.'));
            }
          }
          else
          {
              return response()->json(['error' => __('Permission denied.')], 401);
          }
        
    }
    
    public function purchaseupdate(Request $request, $id){
        
        $productService = ProductService::find($id);
        $productService->purchase = $request->purchase;
        $productService->order_id = $request->order_id;
        $productService->track_id = $request->track_id;
        $update = $productService->update();
        if($update){
            return redirect()->back()->with('success', __('Product successfully updated.'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function deliverupdate(Request $request, $id){

        $productService = ProductService::find($id);
        $productService->delivery = $request->delivery;
        $productService->recived = $request->recived;
        $productService->acount_id = !empty($request->acount_id) ? implode(',', $request->acount_id) : '';
        $productService->warehouse_id = $request->warehouse_id;
        $productService->label = $request->label;
        $fileName = time() . "_" . $request->pdf->getClientOriginalName();
        $path =    $request->pdf->storeAs('uploads/fnskupdf', $fileName);
           $productService->pdf = $fileName;
           $productService->pdf_url = $path;
           $productService->pickupdate = $request->pickupdate;
            $productService->pickuptime = $request->pickuptime;
        $update = $productService->update();
        if($update){
            return redirect()->back()->with('success', __('Product successfully updated.'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function dimenupdate(Request $request, $id){
        $sumlab=0;
        $sumbox=0;
        // $boxcost = 0;
        // $boxno= 0;
        // $labourcost = 0;
        $productService = ProductService::find($id);
        $boxdimens = $request->boxdimens;
        for($i = 0; $i < count($boxdimens); $i++)
        {
            $productThpl              = new ProductThpl();
            $productThpl->product = $id;
            $productThpl->threepl = $boxdimens[$i]['boxdimen'];
            $productThpl->weightlbs = $boxdimens[$i]['weightlbs'];
            $productThpl->unitperbox =$boxdimens[$i]['unitperbox'];
            $productThpl->boxno = $boxdimens[$i]['boxno'];
            $productThpl->labourcost = $boxdimens[$i]['labourcost'];
            $insert = $productThpl->save();
        }
 
        $prodthpls =  $productService->threepls;
        foreach($prodthpls as $prodthpl){
          
             return $boxname = $productService->thpl($prodthpl->threepl);
            $no = $prodthpls->boxno;
            $boxno = $prodthpls->sum('boxno');
            $labour = $boxname->labourcost * $no;
            $boxcost = $boxname->boxcost * $no;
            $sumlab += $labour;
            $sumbox += floatval($boxcost);
        }
         $productService->boxdimen = !empty($request->boxdimen) ? implode(',', $request->boxdimen) : '';
         $productService->boxcost = $sumbox;
         $productService->labourcost = $sumlab;
         $productService->boxno =$boxno;
         $update = $productService->update();
        if($update){
            return redirect()->back()->with('success', __('Product successfully updated.'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function prodisapprove($type){
        if(!empty($type)){
                $productServices = ProductService::where('type' , $type)->where('status','disapprove')->get();;
        }else{
            $productServices = ProductService::where('status','disapprove')->get();;
        }
     
            return view('productservice.disaprove', compact('productServices'));
       
    }
    public function prodrecive($type){
        if(!empty($type)){
            $productServices = ProductService::where('recived','recieved')->where('type',$type)->get();;
        }else{
        $productServices = ProductService::where('recived','recieved')->get();;
        }
     
            return view('productservice.recieve', compact('productServices'));
       
    }
    
        public function prodinvoice($type){
        
        $productServices = ProductService::where('invoice','invoiced')->where('shipped', null)->get();;
        $prod = InvoiceProduct::get()->pluck('product_id')->toArray();
        $prodin = ProductService::whereIn('id',$prod)->where('shipped', null)->where('invoice','invoiced')->where('type',$type)->get();
    
            return view('productservice.invoice', compact('prodin'));
       
    } 

    public function prodship($type){
        
        $productServices = ProductService::where('shipped','shipped')->where('type',$type)->get();
            return view('productservice.shipped', compact('productServices'));
       
    } 

    public function prodapprove($type){
        if(!empty($type)){
            $productServices = ProductService::where('status','approve')->where('purchase','!=','purchased')->where('recived','not_recieved')->where('type',$type)->get();
        }else{
            $productServices = ProductService::where('status','approve')->where('recived','not_recieved')->where('purchase','!=','purchased')->get();
        }
     
            return view('productservice.aprove', compact('productServices'));
       
    }
    public function prodapproved(){
    
            $productServices = ProductService::where('status','approve')->where('recived','not_recieved')->where('purchase','!=','purchased')->get();
      
            return view('productservice.aprove', compact('productServices'));
       
    }
    public function prodpurchase($type){
        if(!empty($type)){
        $productServices = ProductService::where('status','approve')->where('purchase','purchased')->where('recived','!=','recieved')->where('type',$type)->get(); 
        }else{
            $productServices = ProductService::where('status','approve')->where('purchase','purchased')->where('recived','recieved')->get();;
        }
            return view('productservice.puchase', compact('productServices'));
       
    }

    public function destroy($id)
    {
        if(\Auth::user()->can('delete product & service'))
        {
            $productService = ProductService::find($id);
            if($productService->created_by == \Auth::user()->creatorId())
            {
                $productService->delete();

                return redirect()->route('productservice.index')->with('success', __('Product successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function export()
    {
        $name = 'product_service_' . date('Y-m-d i:h:s');
        $data = Excel::download(new ProductServiceExport(), $name . '.xlsx');

        return $data;
    }

    public function importFile()
    {
        return view('productservice.import');
    }

//    public function import(Request $request)
//    {
//
//        $rules = [
//            'file' => 'required|mimes:csv,txt',
//        ];
//
//        $validator = \Validator::make($request->all(), $rules);
//
//        if($validator->fails())
//        {
//            $messages = $validator->getMessageBag();
//
//            return redirect()->back()->with('error', $messages->first());
//        }
//
//        $products     = (new ProductServiceImport)->toArray(request()->file('file'))[0];
//        $totalProduct = count($products) - 1;
//        $errorArray   = [];
//        for($i = 1; $i <= count($products) - 1; $i++)
//        {
//            $items  = $products[$i];
//            $vendor = Vender::where('name', $items[3])->first();
//
//            $taxes     = explode(';', $items[6]);
//            $taxesData = [];
//            foreach($taxes as $tax)
//            {
//                $taxes       = Tax::where('name', $tax)->first();
//                $taxesData[] = $taxes->id;
//            }
//
//            $taxData = implode(',', $taxesData);
//
//            $category = ProductServiceCategory::where('name', $items[7])->first();
//            $unit     = ProductServiceUnit::where('name', $items[8])->first();
////
////            $stockStausArray = \App\ProductService::$stockStatus;
////            $stockStaus      = array_search($items[9], $stockStausArray);
//
//            $productBySku = ProductService::where('sku', $items[1])->first();
//            if(!empty($productBySku))
//            {
//                $productService = $productBySku;
//            }
//            else
//            {
//                $productService = new ProductService();
//            }
//
//
//            $productService->name           = $items[0];
//            $productService->sku            = $items[1];
//            $productService->quantity       = $items[2];
//            $productService->assign_vendor  = !empty($vendor) ? $vendor->id : 0;
//            $productService->sale_price     = $items[4];
//            $productService->purchase_price = $items[5];
//            $productService->tax_id         = $taxData;
//            $productService->category_id    = !empty($category) ? $category->id : 0;
//            $productService->unit_id        = !empty($unit) ? $unit->id : 0;
//            $productService->type           = $items[9];
//            $productService->description    = $items[10];
//            $productService->created_by     = \Auth::user()->creatorId();
//
//            if(empty($vendor) || empty($taxData) || empty($category) || empty($unit) )
//            {
//                $errorArray[] = $items;
//            }
//            else
//            {
//                $productService->save();
//            }
//
//        }
//
//        $errorRecord = [];
//        if(empty($errorArray))
//        {
//
//            $data['status'] = 'success';
//            $data['msg']    = __('Record successfully imported');
//        }
//        else
//        {
//            $data['status'] = 'error';
//            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalProduct . ' ' . 'record');
//
//
//            foreach($errorArray as $errorData)
//            {
//
//                $errorRecord[] = implode(',', $errorData);
//
//            }
//
//            \Session::put('errorArray', $errorRecord);
//        }
//
//        return redirect()->back()->with($data['status'], $data['msg']);
//    }


    public function import(Request $request)
    {
        $rules = [
            'file' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $products     = (new ProductServiceImport)->toArray(request()->file('file'))[0];
        $totalProduct = count($products) - 1;
        $errorArray   = [];
        for ($i = 1; $i <= count($products) - 1; $i++) {
            $items  = $products[$i];

            $taxes     = explode(';', $items[5]);

            $taxesData = [];
            foreach ($taxes as $tax)
            {
                $taxes       = Tax::where('id', $tax)->first();
                //                $taxesData[] = $taxes->id;
                $taxesData[] = !empty($taxes->id) ? $taxes->id : 0;


            }

            $taxData = implode(',', $taxesData);
            //            dd($taxData);

            if (!empty($productBySku)) {
                $productService = $productBySku;
            } else {
                $productService = new ProductService();
            }


            $productService->name           = $items[0];
            $productService->sale_price     = $items[1];
            $productService->purchase_price = $items[2];
            $productService->quantity       = $items[3];
            $productService->tax_id         = $items[4];
            $productService->category_id    = $items[5];
            $productService->unit_id        = $items[6];
            $productService->type           = $items[7];
            $productService->description    = $items[8];
            $productService->created_by     = \Auth::user()->creatorId();

            if (empty($productService)) {
                $errorArray[] = $productService;
            } else {
                $productService->save();
            }
        }

        $errorRecord = [];
        if (empty($errorArray)) {

            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        } else {
            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalProduct . ' ' . 'record');


            foreach ($errorArray as $errorData) {

                $errorRecord[] = implode(',', $errorData);
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }


}
