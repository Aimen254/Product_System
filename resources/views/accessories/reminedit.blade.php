
    {{ Form::model($remind, array('route' => array('leads.reminds.update', $lead->id, $remind->id), 'method' => 'PUT')) }}

<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('time', __('Time'),['class'=>'form-label']) }} <small class="font-weight-bold">{{ __(' (Format h:m:s i.e 00:35:20 means 35 Minutes and 20 Sec)') }}</small>
            {{ Form::time('time', null, array('class' => 'form-control','placeholder'=>'00:35:20','step'=>'2')) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('date', __('Date'),['class'=>'form-label']) }}
            {{Form::date('date',null,array('class'=>'form-control','required'=>'required'))}}

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
   
        <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
   
</div>
{{Form::close()}}

