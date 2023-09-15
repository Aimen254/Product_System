@extends('layouts.admin')
@section('page-title')
    {{__('Manage Product & Services')}}
@endsection
@push('script-page')


@endpush
@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('productservice.index')}}">{{__('Product Management')}}</a></li>
    <li class="breadcrumb-item">{{__('Product Recieved')}}</li>
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
                                <th>{{__('Purchase Status')}}</th>
                                <th>{{__('Account')}}</th>
                                <th>{{__('Warehouse')}}</th>
                                <th>{{__('Delivery')}}</th>
                                <th>{{__('Recieved Status')}}</th>
                                <th>{{__('Return')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productServices as $productService)
                                <tr class="font-style">
                                    <td>{{ $productService->name}}</td>
                                    <td>
                                    {{$productService->purchase}}
                                    </td>
                                    <td>  
                                        @if(!empty($productService->acount_id))
                                            @php
                                                $taxes=\Utility::account($productService->acount_id);
                                            @endphp

                                            @foreach($taxes as $tax)
                                                {{ !empty($tax)?$tax->name:''  }}<br>
                                            @endforeach
                                        @else
                                            -
                                        @endif</td>
                                    <td>{{ !empty($productService->warehouse)?$productService->warehouse->name:'' }}</td>
                                    <td>{{ $productService->delivery }}</td>
                                    <td>{{ $productService->recived }}</td>
                                    <td>
                                        <a href="{{ route('product.return',$productService->id) }}" class="badge  bg-danger"   >
                                        <span class="btn-inner--icon">{{__('Return')}}</span>
                                        </a>
                                    </td>
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action" >
                                            <?php
                                               $pid = $productService->id;
                                            ?>
                                         
                                            @can('edit product & service')
                                                <div class="action-btn bg-secondary ms-2">
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
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('productservice.show',$productService->id) }}" class="mx-3 btn btn-sm  align-items-center" title="{{__('Show')}}"  >
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('edit product & service')
                                                  <div class="action-btn">
                                                   <a href="{{ route('dimen.edit',$productService->id) }}" class="btn btn-sm btn-primary  " title="{{__('Purchase Status')}}"  data-title="{{__('Edit Status')}}" >
                                                   <span class="btn-inner--icon">{{__('Dimensions')}}</span>
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
