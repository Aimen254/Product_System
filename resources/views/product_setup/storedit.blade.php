{{ Form::model($store, array('route' => array('stores.update', $store->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Store Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control font-style','required'=>'required')) }}
            @error('name')
            <small class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
        </div>  <div class="form-group col-md-6">
            {{ Form::label('budget', __('Bugdet'),['class'=>'form-label']) }}
            {{ Form::number('budget', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('ownername', __('Account Owner Name'),['class'=>'form-label']) }}
            {{ Form::text('ownername', null, array('class' => 'form-control font-style','required'=>'required')) }}

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
