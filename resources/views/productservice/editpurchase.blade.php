{{ Form::model($productService, array('route' => array('puchase.update', $productService->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('purchase', __('Select Purchase Status'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <select name="purchase" id="status" class="form-control main-element select2">
                <option value="">Select Purchase Status</option>
                    @foreach(\App\Models\ProductService::$purchase_status as $k => $v)
                        <option value="{{$k}}">{{__($v)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 showid" style="display: none;">
            <div class="form-group ">
                {{ Form::label('order_id', __('Order Id'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::text('order_id', '', array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="col-md-6 showid"  style="display: none;">
            <div class="form-group">
                {{ Form::label('track_id', __('Track Id'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::text('track_id', '', array('class' => 'form-control')) }}
            </div>
        </div>
      
     
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}

<script>
$('#status').on('change',function(){
    var some = $(this).find('option:selected').val(); 
    if(some == 'purchased'){
       $('.showid').show();
    }else{
        $('.showid').hide();
    }
});
</script>