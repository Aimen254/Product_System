<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\ProductService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Warehouse::all();
        return view('product_setup.wareindex',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_setup.warecreate');
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

            $tax             = new Warehouse();
            $tax->name       = $request->name;
            $tax->created_by = \Auth::user()->creatorId();
            $tax->save();

            return redirect()->back()->with('success', __('Warehouse successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            if($warehouse->created_by == \Auth::user()->creatorId())
            {
                return view('product_setup.waredit', compact('warehouse'));
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
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            if($warehouse->created_by == \Auth::user()->creatorId())
            {
            
                $warehouse->name = $request->name;
                $warehouse->save();

                return redirect()->back()->with('success', __('warehouse rate successfully updated.'));
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
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        if(\Auth::user()->can('delete product & service'))
        {
            if($warehouse->created_by == \Auth::user()->creatorId())
            {
                $proposalData = ProductService::whereRaw("find_in_set('$warehouse->id',	warehouse_id)")->first();

                if(!empty($proposalData))
                {
                    return redirect()->back()->with('error', __('this warehouse is already assign to ProductService so please move or remove this warehouse related data.'));
                }

                $warehouse->delete();

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
