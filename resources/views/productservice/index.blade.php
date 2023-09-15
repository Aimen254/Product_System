@extends('layouts.admin')
@section('page-title')
    {{__('Manage Product & Services')}}
@endsection
@push('script-page')


@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Product & Services')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
    
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="{{__('Import')}}" data-url="{{ route('productservice.file.import') }}" data-ajax-popup="true" data-title="{{__('Import product CSV file')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="{{route('productservice.export')}}" data-bs-toggle="tooltip" title="{{__('Export')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <!-- <a href="#" data-size="xl" data-url="{{ route('productservice.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New Product')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a> -->
        <a href="#" class="btn btn-sm btn-success  " data-url="{{ route('productservice.create') }}" data-ajax-popup="true"  data-size="md" data-bs-toggle="tooltip" title="{{__('Edit Status')}}"  data-title="{{__('Edit Status')}}" >
                                                   <span class="btn-inner--icon">{{__('Status')}}</span>
                                                    </a>
                                                 
        <!-- <a href="{{ route('productservice.create') }}"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a> -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Sku')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Source')}}</th>
                                <th>{{__('selling')}}</th>
                                <th>{{__('reference')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productServices as $productService)
                                <tr class="font-style">
                                    <td>{{ $productService->name}}</td>
                                    <td>{{ $productService->sku }}</td>
                                    <td>{{ $productService->type }}</td>
                                    <td>{{ $productService->status }}</td>
                                    <td>
                                        <a href="{{url($productService->amzlink)}}" class="badge  bg-info " >
                                           Selling
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url($productService->sourcelink)}}" class="badge  bg-primary"   >
                                           Source
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url($productService->reflink)}}" class="badge  bg-danger" >
                                           Reference
                                        </a>
                                    </td>
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">
                                            <?php
                                               $pid = $productService->id;
                                            ?>
                                            @can('edit product & service')
                                               <div class="action-btn bg-primary ">
                                                   <a href="#" class="btn btn-sm btn-success  " data-url="{{ route('status.edit',$productService->id) }}" data-ajax-popup="true"  data-size="md" data-bs-toggle="tooltip" title="{{__('Edit Status')}}"  data-title="{{__('Edit Status')}}" style="margin-right: 10px;">
                                                   <span class="btn-inner--icon">{{__('Status')}}</span>
                                                    </a>
                                                 
                                                </div>
                                            @endcan
                                            @can('edit product & service')
                                                <div class="action-btn bg-primary ms-2">
                                                    <!-- <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('productservice.edit',$productService->id) }}" data-ajax-popup="true"  data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Product Edit')}}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a> -->
                                                    <a href="{{ route('productservice.edit',$productService->id) }}" class="mx-3 btn btn-sm  align-items-center" >
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('edit product & service')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('productservice.show',$productService->id) }}" class="mx-3 btn btn-sm  align-items-center" title="{{__('Show')}}"  >
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('delete product & service')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['productservice.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]) !!}
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="ti ti-trash text-white"></i></a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
                                        </td>
                                    @endif
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
