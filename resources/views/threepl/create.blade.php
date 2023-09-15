{{ Form::open(array('url' => 'threepl')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('size', __('Size'),['class'=>'form-label']) }}
            {{ Form::text('size', '', array('class' => 'form-control','required'=>'required')) }}
            @error('name')
            <small class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('landedcost', __('Landed Cost'),['class'=>'form-label']) }}
            {{ Form::number('landedcost', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('tax', __('Tax%'),['class'=>'form-label']) }}
            {{ Form::number('tax', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
            @error('rate')
            <small class="invalid-rate" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
            @enderror
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('shipping', __('Shipping'),['class'=>'form-label']) }}
            {{ Form::number('shipping', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('markup', __('Markup'),['class'=>'form-label']) }}
            {{ Form::number('markup', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('boxcost', __('ById,s Box Cost'),['class'=>'form-label']) }}
            {{ Form::number('boxcost', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('labourcost', __('ById,s Labour Cost'),['class'=>'form-label']) }}
            {{ Form::number('labourcost', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
