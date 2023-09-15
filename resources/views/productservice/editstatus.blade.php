{{ Form::model($productService, array('route' => array('status.update', $productService->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('status', __('Select Status'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <select name="status" id="status" class="form-control main-element select2">
                    @foreach(\App\Models\ProductService::$product_status as $k => $v)
                        <option value="{{$k}}">{{__($v)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

     
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}

