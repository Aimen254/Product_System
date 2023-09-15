@extends('layouts.admin')
@section('page-title')
    {{__('Manage Tax Rate')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Taxes')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @can('create constant tax')
            <a href="#" data-url="{{ route('threepl.create') }}" data-ajax-popup="true" data-title="{{__('Create Tax Rate')}}" data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            @include('layouts.account_setup')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Size')}}</th>
                                <th>{{__('Landed Cost')}}</th>
                                <th>{{__('shipping')}}</th>
                                <th>{{__('Markup')}}</th>
                                <th>{{__('Tax')}}</th>
                                <th>{{__('ById,s Box Cost')}}</th>
                                <th>{{__('ById,s Labour Cost')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($thpls as $thpl)
                                <tr class="font-style">
                                    <td>{{ $thpl->size}}</td>
                                    <td>{{ \Auth::user()->priceFormat($thpl->landedcost ) }}</td>
                                    <td>{{ $thpl->shipping }}%</td>
                                    
                                    <td>{{ $thpl->markup }}%</td>
                                    <td>{{$thpl->tax}}%</td>
                                    <td>{{ \Auth::user()->priceFormat($thpl->boxcost ) }}</td>
                                    <td>{{ \Auth::user()->priceFormat($thpl->labourcost ) }}</td>

                                    <td class="Action">
                                        <span>
                                        @can('edit constant tax')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('threepl.edit',$thpl->id) }}" data-ajax-popup="true" data-title="{{__('Edit Tax Rate')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                                </div>
                                            @endcan
                                            @can('delete constant tax')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['threepl.destroy', $thpl->id],'id'=>'delete-form-'.$thpl->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$thpl->id}}').submit();">
                                                <i class="ti ti-trash text-white"></i>
                                            </a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
                                        </span>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
