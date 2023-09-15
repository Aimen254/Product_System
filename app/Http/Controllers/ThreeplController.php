<?php

namespace App\Http\Controllers;

use App\Models\Threepl;
use Illuminate\Http\Request;

class ThreeplController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thpls= Threepl::all();
        return view('threepl.index' , compact('thpls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('create constant tax'))
        {
            return view('threepl.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
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
            $thpl             = new Threepl();
            $thpl->size       = $request->size;
            $thpl->landedcost       = $request->landedcost;
            $thpl->tax       = $request->tax;
            $thpl->shipping       = $request->shipping;
            $thpl->markup       = $request->markup;
            $thpl->boxcost       = $request->boxcost;
            $thpl->labourcost       = $request->labourcost;
            $thpl->created_by = \Auth::user()->creatorId();
            $thpl->save();

            return redirect()->route('taxes.index')->with('success', __('Tax rate successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Threepl  $threepl
     * @return \Illuminate\Http\Response
     */
    public function show(Threepl $threepl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Threepl  $threepl
     * @return \Illuminate\Http\Response
     */
    public function edit(Threepl $threepl)
    {
        if(\Auth::user()->can('edit constant tax'))
        {
          
                return view('threepl.edit', compact('threepl'));
          
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
     * @param  \App\Models\Threepl  $threepl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Threepl $threepl)
    {
        if(\Auth::user()->can('edit constant tax'))
        {
         
            $threepl->size       = $request->size;
            $threepl->landedcost       = $request->landedcost;
            $threepl->tax       = $request->tax;
            $threepl->shipping       = $request->shipping;
            $threepl->markup       = $request->markup;
            $threepl->boxcost       = $request->boxcost;
            $threepl->labourcost       = $request->labourcost;
                $threepl->save();

                return redirect()->route('threepl.index')->with('success', __('3PL successfully updated.'));
           
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Threepl  $threepl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Threepl $threepl)
    {
        if(\Auth::user()->can('delete constant tax'))
        {

                $threepl->delete();

                return redirect()->route('threepl.index')->with('success', __('3PL successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
