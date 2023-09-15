<?php

namespace App\Http\Controllers;

use App\Models\Acount;
use App\Models\ProductService;
use Illuminate\Http\Request;

class AcountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Acount::all();
        return view('product_setup.acountindex',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_setup.acountcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('create constant tax'))
        {

            $tax             = new Acount();
            $tax->name       = $request->name;
            $tax->ownername       = $request->ownername;
            $tax->created_by = \Auth::user()->creatorId();
            $tax->save();

            return redirect()->back()->with('success', __('Account successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acount  $acount
     * @return \Illuminate\Http\Response
     */
    public function show(Acount $acount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acount  $acount
     * @return \Illuminate\Http\Response
     */
    public function edit(Acount $acount)
    {
        if(\Auth::user()->can('edit constant tax'))
        {
            if($acount->created_by == \Auth::user()->creatorId())
            {
                return view('product_setup.acountedit', compact('acount'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acount  $acount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acount $acount)
    {
        if(\Auth::user()->can('edit constant tax'))
        {
            if($acount->created_by == \Auth::user()->creatorId())
            {
            
                $acount->name = $request->name;
                $acount->save();

                return redirect()->back()->with('success', __('Account rate successfully updated.'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acount  $acount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acount $acount)
    {
        if(\Auth::user()->can('delete constant tax'))
        {
            if($acount->created_by == \Auth::user()->creatorId())
            {
                $proposalData = ProductService::whereRaw("find_in_set('$acount->id',acount_id)")->first();

                if(!empty($proposalData))
                {
                    return redirect()->back()->with('error', __('this Account is already assign to ProductService so please move or remove this account related data.'));
                }

                $acount->delete();

                return redirect()->back()->with('success', __('Account rate successfully deleted.'));
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
}
