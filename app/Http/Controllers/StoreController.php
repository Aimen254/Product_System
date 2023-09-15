<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\ProductService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Store::all();
        return view('product_setup.storeindex',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_setup.storecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('create product & service'))
        {

            $tax             = new Store();
            $tax->name       = $request->name;
            $tax->buddet       = $request->budget;
            $tax->blnce       = $request->budget;
            $tax->created_by = \Auth::user()->creatorId();
            $tax->save();

            return redirect()->back()->with('success', __('Store successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            if($store->created_by == \Auth::user()->creatorId())
            {
                return view('product_setup.storedit', compact('store'));
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            if($store->created_by == \Auth::user()->creatorId())
            {
            
                $store->name = $request->name;
                $store->budget       = $request->budget;
                $store->blnce       = $request->budget;
                $store->save();

                return redirect()->back()->with('success', __('store successfully updated.'));
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if(\Auth::user()->can('delete product & service'))
        {
            if($store->created_by == \Auth::user()->creatorId())
            {
                $proposalData = ProductService::whereRaw("find_in_set('$store->id',acount_id)")->first();

                if(!empty($proposalData))
                {
                    return redirect()->back()->with('error', __('this Account is already assign to ProductService so please move or remove this account related data.'));
                }

                $store->delete();

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
