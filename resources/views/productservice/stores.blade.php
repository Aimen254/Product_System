{{ Form::model($productService, array('route' => array('prod.stores.update', $productService->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            {{ Form::label('stores', __('Stores'),['class'=>'form-label']) }}
            
            {{ Form::select('stores[]', $stores,false, array('class' => 'form-control select2','id'=>'choices-multiple3','multiple'=>'')) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

