<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Interview Schedule')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>

    <script type="text/javascript">

        (function () {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                initialDate: '<?php echo e($transdate); ?>',
                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events:<?php echo $arrSchedule; ?>,
            });
            calendar.render();
        })();
    </script>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create interview schedule')): ?>
            <a href="#" data-url="<?php echo e(route('interview-schedule.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Interview Schedule')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Calendar')); ?></h5>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4"><?php echo e(__('Schedule List')); ?></h4>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        <li class="list-group-item card mb-3">
                            <div class="row align-items-center justify-content-between">
                                <div class=" align-items-center">
                                        <?php if(!$schedules->isEmpty()): ?>
                                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="card mb-3 border shadow-none">
                                                    <div class="px-3">
                                                        <div class="row align-items-center">
                                                            <div class="col ml-n2">
                                                                <h5 class="text-sm mb-0">
                                                                    <a href="#!"><?php echo e(!empty($schedule->applications) ? !empty($schedule->applications->jobs) ? $schedule->applications->jobs->title : '' : ''); ?></a>
                                                                </h5>
                                                                <p class="card-text small text-muted">
                                                                    <?php echo e(!empty($schedule->applications)?$schedule->applications->name:''); ?>

                                                                </p>
                                                                <p class="card-text small text-muted">
                                                                    <?php echo e(\Auth::user()->dateFormat($schedule->date).' '. \Auth::user()->timeFormat($schedule->time)); ?>

                                                                </p>
                                                            </div>
                                                            <div class="col-auto text-right">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit interview schedule')): ?>
                                                                    <div class="action-btn bg-primary ms-2">
                                                                        <a href="#" data-url="<?php echo e(route('interview-schedule.edit',$schedule->id)); ?>" data-title="<?php echo e(__('Edit Interview Schedule')); ?>" data-ajax-popup="true" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete interview schedule')): ?>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['interview-schedule.destroy', $schedule->id],'id'=>'delete-form-'.$schedule->id]); ?>

                                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($schedule->id); ?>').submit();"><i class="ti ti-trash text-white"></i></a>
                                                                        <?php echo Form::close(); ?>

                                                                        </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="text-center">
                                                <?php echo e(__('No Interview Scheduled!')); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                            </div>

                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/crm/resources/views/interviewSchedule/index.blade.php ENDPATH**/ ?>