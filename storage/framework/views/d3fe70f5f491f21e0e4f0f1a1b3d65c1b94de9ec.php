<?php echo e(Form::open(array('url' => 'contract'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('client_name', __('Client'))); ?>

            <?php echo e(Form::select('client_name', $clients,null, array('class' => 'form-control','data-toggle="select"','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('subject', __('Subject'))); ?>

            <?php echo e(Form::text('subject', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('type', __('Contract Type'))); ?>

            <?php echo e(Form::select('type', $contractTypes,null, array('class' => 'form-control','data-toggle="select"','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('value', __('Contract Value'))); ?>

            <?php echo e(Form::number('value', '', array('class' => 'form-control','required'=>'required','stage'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'))); ?>

            <?php echo e(Form::date('start_date', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'))); ?>

            <?php echo e(Form::date('end_date', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'))); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'3']); ?>

        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home2/babarras/public_html/crm/resources/views/contract/create.blade.php ENDPATH**/ ?>