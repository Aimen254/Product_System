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

        <a href="#" data-size="xl" data-url="{{ route('productservice.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New Product')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0">{{__('Sale price')}}</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-info">
                                            <small>{{$productService->sale_price}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                    <h3 class="m-0">{{__('Purchase Cost Exc ST')}}</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-primary">
                                        
                                        <small>{{$productService->purchase_price}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0">{{__('Source price')}}</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-warning">
                                        
                                        <small>{{$productService->sourceprice}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0">{{__('Total Profiit')}}</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-success">
                                        
                                        <small>{{$productService->profit}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0">{{__('Net Profit')}}</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-secondary">
                                        
                                        <small>{{$productService->netprofit}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> {{__('Total Cost Inc. ST')}}</h5>
                                            <p class="mb-0 text-sm">
                                                {{$productService->totalcostin}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> {{__('Total Cost')}}</h5>
                                            <p class="mb-0 text-sm">
                                                {{$productService->totalcost}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> {{__('Total Revenue')}}</h5>
                                            <p class="mb-0 text-sm">
                                                {{$productService->totlrev}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> {{__('ROI')}}</h5>
                                            <p class="mb-0 text-sm">
                                                {{$productService->ROI}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            
                            <h5 class="mb-0"><a class="text-dark" href="#">{{ $productService->name }}</a></h5>
                        </div>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <div class="col-auto"><span class="badge rounded-pill bg-primary">{{$productService->purchase}}</span>
                                </div>
                                 <a href="{{url($productService->sourcelink)}}" class="badge  bg-info">source link</a>&nbsp; &nbsp; 
                                <a href="{{url($productService->amzlink)}}" class="badge  bg-danger">Amazon Link</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 justify-content-between">
                            <div class="col-auto"><span class="badge rounded-pill bg-{{\App\Models\ProductService::$status_color[$productService->status]}}">{{ __(\App\Models\ProductService::$product_status[$productService->status]) }}</span>
                            </div>
                            <p class="text-muted text-sm mt-3">{{ $productService->description }}</p>
                        </div>
                        <div class="card mb-0 mt-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0">{{__('Source Pack')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->sourcepack}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('Selling Pack')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->selpack}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('QTY to Purchase')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->quantity}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('shipping')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->shipping}}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0">{{__('Tax')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->tax_id}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('AMZ Unit')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->unit_id}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('Bundle Cost')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->bundlecost}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('FBA Fee')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->fbafee}}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0">{{__('Ref Fee')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->reffee}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('AMZ Shipment')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->amzship}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('3PL')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->thpl}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('Cost Exl. FBA')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->costexl}}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0">{{__('Cost Exl. Ref & FBA')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->costexlfb}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('Order Value')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->orderval}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('ASIN')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->asin}}</p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0">{{__('SKU')}}</h6>
                                        <p class="text-muted text-sm mb-0">{{$productService->sku}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-0 mt-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6 class="mb-0">{{ Utility::getDateFormated($productService->date) }}</h6>
                                        <p class="text-muted text-sm mb-0">{{__(' Date')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    
    </div>
</div>
@endsection
