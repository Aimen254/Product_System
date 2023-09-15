@extends('layouts.admin')
@section('page-title')
    {{__('Journal Entry Create')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Double Entry')}}</li>
    <li class="breadcrumb-item">{{__('Journal Entry')}}</li>
@endsection

@push('script-page')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{asset('js/jquery.repeater.min.js')}}"></script>
  
@endpush
@section('content')

{{ Form::model($productServices, array('route' => array('label.update', $productServices->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-xl-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                          
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="boxdimens" id="sortable-table">
                            <thead>
                            <tr>
                                <th>{{__('Box')}}</th>
                                <th>{{__('Weight lbs')}}</th>
                                <th>{{__('Unit Per Box')}} </th>
                                <th>{{__('Number of Boxess')}}</th>
                                <th>{{__('Carrier Label')}}</th>
                                <th>{{__('Recieving Label')}}</th>
                                <th width="2%"></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item>
                            @foreach ($productService as $productServic)
                            <tr>
                                <?php
                                $box = $productServic->threepl;
                                  $thpl = $productServic->thpl($box);
                                ?>
                                <td>
                                    <div class="form-group price-input">
                                    {{ Form::text('threepl', $thpl->size, array('class' => 'form-control','required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                    {{ Form::number('weightlbs', $productServic->weightlbs, array('class' => 'form-control','required'=>'required')) }}
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                    {{ Form::number('unitperbox', $productServic->unitperbox, array('class' => 'form-control','required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    {{ Form::number('boxno', $productServic->boxno, array('class' => 'form-control','required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    {{ Form::file('carlabel') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    {{ Form::file('recvlabel') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-danger" data-repeater-delete></a>
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

    <div class="modal-footer">
        <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("journal-entry.index")}}';" class="btn btn-light">
        <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
    </div>
    {{ Form::close() }}

@endsection


