<?php

namespace App\Http\Controllers;

use App\Models\AccessType;
use Illuminate\Http\Request;

class AccessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('manage constant custom field'))
        {
            $custom_fields = AccessType::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('accessoriestype.index', compact('custom_fields'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('create constant custom field'))
        {
       
            return view('accessoriestype.create');
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
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
        if(\Auth::user()->can('create constant custom field'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required|max:40',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('access-type.index')->with('error', $messages->first());
            }

            $custom_field             = new AccessType();
            $custom_field->name       = $request->name;
            $custom_field->created_by = \Auth::user()->creatorId();
            $custom_field->save();

            return redirect()->route('access-type.index')->with('success', __('Access Type successfully created!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessType  $accessType
     * @return \Illuminate\Http\Response
     */
    public function show(AccessType $accessType)
    {
         return redirect()->route('accessoriestype.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessType  $accessType
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessType $accessType)
    {
        if(\Auth::user()->can('edit constant custom field'))
        {
            if($accessType->created_by == \Auth::user()->creatorId())
            {
               
                return view('accessoriestype.edit', compact('accessType'));
            }
            else
            {
                return response()->json(['error' => __('Permission Denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccessType  $accessType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessType $accessType)
    {
        if(\Auth::user()->can('edit constant custom field'))
        {

            if( $accessType->created_by == \Auth::user()->creatorId())
            {

                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required|max:40',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('access-type.index')->with('error', $messages->first());
                }

                $accessType->name = $request->name;
                $accessType->save();

                return redirect()->route('access-type.index')->with('success', __(' Access Type successfully updated!'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessType  $accessType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessType $accessType)
    {
        if(\Auth::user()->can('delete constant custom field'))
        {
            if($accessType->created_by == \Auth::user()->creatorId())
            {
                $accessType->delete();

                return redirect()->route('access-type.index')->with('success', __('Access Type successfully deleted!'));
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
}
