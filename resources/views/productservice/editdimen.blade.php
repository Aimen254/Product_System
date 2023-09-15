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
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            // var $dragAndDrop = $("body .repeater tbody").sortable({
            //     handle: '.sort-handler'
            // });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    if($('.select2').length) {
                        $('.select2').select2();
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));


                    }
                },
                ready: function (setIndexes) {
                    // $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');

            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                }
            }

        }

    </script>
@endpush
@section('content')

{{ Form::model($productService, array('route' => array('dimen.update', $productService->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-xl-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <a href="#" data-repeater-create="" class="btn btn-primary mr-2" data-toggle="modal" data-target="#add-bank">
                                <i class="ti ti-plus"></i> {{__('Add Box')}}
                            </a>
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
                                <th>{{__('Labour Cost')}}</th>
                                <th width="2%"></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td width="25%" class="form-group pt-0">
                                {{ Form::select('boxdimen', $thpl,'', array('class' => 'form-control select','required'=>'required')) }}

                                </td>

                                <td>
                                    <div class="form-group price-input">
                                    {{ Form::number('weightlbs', '', array('class' => 'form-control','required'=>'required')) }}
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                    {{ Form::number('unitperbox', '', array('class' => 'form-control','required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    {{ Form::number('boxno', '', array('class' => 'form-control','required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    {{ Form::number('labourcost', '', array('class' => 'form-control','required'=>'required')) }}
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-danger" data-repeater-delete></a>
                                </td>
                            </tr>
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


