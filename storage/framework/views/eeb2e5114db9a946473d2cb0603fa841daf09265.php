<?php echo e(Form::open(array('url'=>'warning','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <?php if(\Auth::user()->type != 'employee'): ?>
            <div class="form-group col-md-6 col-lg-6">
                <?php echo e(Form::label('warning_by', __('Warning By'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('warning_by', $employees,null, array('class' => 'form-control select','required'=>'required'))); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('warning_to',__('Warning To'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('warning_to',$employees,null,array('class'=>'form-control select'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('subject',__('Subject'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('subject',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('warning_date',__('Warning Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('warning_date',null,array('class'=>'form-control '))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))); ?>

        </div>
        
    </div>
    
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

    <?php echo e(Form::close()); ?>

<?php /**PATH /home3/amarcmar/public_html/crm/resources/views/warning/create.blade.php ENDPATH**/ ?>