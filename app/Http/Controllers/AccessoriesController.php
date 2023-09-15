<?php

namespace App\Http\Controllers;

use App\Models\Accessories;

use App\Models\AccessType;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Accessories::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('type', 'id');
        $category->prepend('Select Type', '');

        if(!empty($request->category))
        {

            $productServices = Accessories::where('created_by', '=', \Auth::user()->creatorId())->where('type', $request->type)->get();
        }
        else
        {
            $productServices = Accessories::where('created_by', '=', \Auth::user()->creatorId())->get();
        }
        return view('accessories.index', compact('productServices', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(\Auth::user()->can('create product & service'))
        {
            $type         = AccessType::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('accessories.create', compact('type'));
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
        if(\Auth::user()->can('create product & service'))
        {

            $rules = [
                'name' => 'required',
              
            ];

            $validator = \Validator::make($request->all(), $rules);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('access.index')->with('error', $messages->first());
            }

            $access                = new Accessories();
            $access->name           = $request->name;
            $access->description    = $request->description;
            $access->price     = $request->price;
            $access->quantity        = $request->quantity;
            $access->type           = $request->type_id;
            $access->created_by     = \Auth::user()->creatorId();
            $access->save();

            return redirect()->route('access.index')->with('success', __('Accessories successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function show(Accessories $accessories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessories $accessories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accessories $accessories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessories $accessories)
    {
        //
    }
}
