@extends('layouts.admin')
@section('page-title')
    {{__('Manage Product & Services')}}
@endsection
@push('script-page')


@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('productservice.index')}}">{{__('Product Management')}}</a></li>
    <li class="breadcrumb-item">{{__('Product Purchase')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
    
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="{{__('Import')}}" data-url="{{ route('productservice.file.import') }}" data-ajax-popup="true" data-title="{{__('Import product CSV file')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="{{route('productservice.export')}}" data-bs-toggle="tooltip" title="{{__('Export')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="xl" data-url="{{ route('productservice.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New Product')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
           
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
                                <th>{{__('type')}}</th>
                                <th>{{__('Recieve_status')}}</th>
                                <th>{{__('Add_Store')}}</th>
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
                                    <td>{{$productService->type}}</td>
                                    <td>{{ $productService->recived }}</td>
                                    <td>
                                        <a href="#" data-size="md" data-url="{{ route('prod.store.edit',$productService->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Add User')}}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </td>
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
                                        <td class="Action" >
                                            <?php
                                               $pid = $productService->id;
                                            ?>
                                         
                                            @can('edit product & service')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('productservice.edit',$productService->id) }}" data-ajax-popup="true"  data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Product Edit')}}">
                                                        <i class="ti ti-pencil text-white"></i>
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
                                            
                                            @can('edit product & service')
                                                  <div class="action-btn">
                                                   <a href="#" class="btn btn-sm btn-primary  " data-url="{{ route('delivery.edit',$productService->id) }}" data-ajax-popup="true"  data-size="md" data-bs-toggle="tooltip" title="{{__('Purchase Status')}}"  data-title="{{__('Edit Status')}}" style="margin-left: 60px; ">
                                                   <span class="btn-inner--icon">{{__('Delivery')}}</span>
                                                    </a>
                                                 
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
