<?php echo e(Form::open(array('route'=>array('job.on.board.store',$id),'method'=>'post'))); ?>

<div class="modal-body">

    <div class="row">
        <?php if($id==0): ?>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('application',__('Interviewer'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('application',$applications,null,array('class'=>'form-control select','required'=>'required'))); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-12">
            <?php echo Form::label('joining_date', __('Joining Date'),['class'=>'form-label']); ?>

            <?php echo Form::date('joining_date', null, ['class' => 'form-control ']); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('status',$status,null,array('class'=>'form-control select'))); ?>

        </div>
       
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>



<?php /**PATH /home2/babarras/public_html/crm/resources/views/jobApplication/onboardCreate.blade.php ENDPATH**/ ?>