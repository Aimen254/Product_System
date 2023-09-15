<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo = \App\Models\Utility::GetLogo();
    $company_small_logo=Utility::getValByName('company_small_logo');
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();



?>

<nav class="dash-sidebar light-sidebar <?php echo e((isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''); ?>">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">



                <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                     alt="<?php echo e(env('APP_NAME')); ?>" class="logo logo-lg nav-sidebar-logo" />


            </a>
        </div>
        <div class="navbar-content">
            <?php if(\Auth::user()->type != 'client'): ?>
                <ul class="dash-navbar">

                    <!--------------------- Start Dashboard ----------------------------------->

                    <?php if( Gate::check('show hrm dashboard') || Gate::check('show project dashboard') || Gate::check('show account dashboard')): ?>
                        <li class="dash-item dash-hasmenu
                                <?php echo e(( Request::segment(1) == null ||Request::segment(1) == 'dashboard' || Request::segment(1) == 'income report'
                                   || Request::segment(1) == 'report' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'reports-leave' ||
                                    Request::segment(1) == 'reports-monthly-attendance') ?'active dash-trigger':''); ?>">
                            <a href="<?php echo e(route('dashboard')); ?>" class="dash-link "><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                         
                        </li
                    <?php endif; ?>

                <!--------------------- End Dashboard ----------------------------------->


                    <!--------------------- Start HRM ----------------------------------->

                    <!-- <?php if(\Auth::user()->show_hrm() == 1): ?>
                        <?php if( Gate::check('manage employee') || Gate::check('manage setsalary')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'reports-monthly-attendance' ||
                                Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'leavetype' || Request::segment(1) == 'leave' ||
                                Request::segment(1) == 'attendanceemployee' || Request::segment(1) == 'document-upload' || Request::segment(1) == 'document' || Request::segment(1) == 'performanceType'  ||
                                    Request::segment(1) == 'branch' || Request::segment(1) == 'department' || Request::segment(1) == 'designation' || Request::segment(1) == 'employee'
                                    || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender'
                                    || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' ||
                                    Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning'
                                     || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'job' || Request::segment(1) == 'job-application' ||
                                      Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question'
                                       || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career' || Request::segment(1) == 'holiday' || Request::segment(1) == 'setsalary' ||
                                       Request::segment(1) == 'payslip' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'company-policy' || Request::segment(1) == 'job-stage'
                                       || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' || Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' ||
                                       Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' || Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption'
                                       || Request::segment(1) == 'deductionoption')?'active dash-trigger':''); ?>">
                                <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-user"></i></span><span class="dash-mtext"><?php echo e(__('HRM System')); ?></span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="dash-submenu">
                                    <li class="dash-item  <?php echo e((Request::segment(1) == 'employee' ? 'active dash-trigger' : '')); ?>   ">
                                        <?php if(\Auth::user()->type =='Employee'): ?>
                                            <?php
                                                $employee=App\Models\Employee::where('user_id',\Auth::user()->id)->first();
                                            ?>
                                            <a class="dash-link" href="<?php echo e(route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt(\Auth::user()->id))); ?>"><?php echo e(__('Employee')); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('employee.index')); ?>" class="dash-link">
                                                <?php echo e(__('Employee Setup')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </li>

                                    <li class="dash-item dash-hasmenu  <?php echo e((Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip') ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Payroll Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage set salary')): ?>
                                                <li class="dash-item <?php echo e((request()->is('setsalary*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('setsalary.index')); ?>"><?php echo e(__('Set salary')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pay slip')): ?>
                                                <li class="dash-item <?php echo e((request()->is('payslip*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Payslip')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>

                                    <li class="dash-item dash-hasmenu  <?php echo e((Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee') ? 'active dash-trigger' :''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Leave Management Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave')): ?>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'leave.index') ?'active' :''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('leave.index')); ?>"><?php echo e(__('Manage Leave')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage attendance')): ?>
                                                <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'attendanceemployee') ? 'active dash-trigger' : ''); ?>" href="#navbar-attendance" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'attendanceemployee') ? 'true' : 'false'); ?>">
                                                    <a class="dash-link" href="#"><?php echo e(__('Attendance')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                    <ul class="dash-submenu">
                                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'attendanceemployee.index' ? 'active' : '')); ?>">
                                                            <a class="dash-link" href="<?php echo e(route('attendanceemployee.index')); ?>"><?php echo e(__('Mark Attendance')); ?></a>
                                                        </li>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create attendance')): ?>
                                                            <li class="dash-item <?php echo e((Request::route()->getName() == 'attendanceemployee.bulkattendance' ? 'active' : '')); ?>">
                                                                <a class="dash-link" href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>"><?php echo e(__('Bulk Attendance')); ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>

                                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'active dash-trigger' : ''); ?>" href="#navbar-performance" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'true' : 'false'); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Performance Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking') ? 'show' : 'collapse'); ?>">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage indicator')): ?>
                                                <li class="dash-item <?php echo e((request()->is('indicator*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('indicator.index')); ?>"><?php echo e(__('Indicator')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage appraisal')): ?>
                                                <li class="dash-item <?php echo e((request()->is('appraisal*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('appraisal.index')); ?>"><?php echo e(__('Appraisal')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage goal tracking')): ?>
                                                <li class="dash-item  <?php echo e((request()->is('goaltracking*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('goaltracking.index')); ?>"><?php echo e(__('Goal Tracking')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>

                                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'active dash-trigger' : ''); ?>" href="#navbar-training" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'trainer' || Request::segment(1) == 'training') ? 'true' : 'false'); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Training Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage training')): ?>
                                                <li class="dash-item <?php echo e((request()->is('training*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('training.index')); ?>"><?php echo e(__('Training List')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage trainer')): ?>
                                                <li class="dash-item <?php echo e((request()->is('trainer*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('trainer.index')); ?>"><?php echo e(__('Trainer')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    </li>

                                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career') ? 'active dash-trigger' : ''); ?>    ">
                                        <a class="dash-link" href="#"><?php echo e(__('Recruitment Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job')): ?>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('job.index')); ?>"><?php echo e(__('Jobs')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create job')): ?>
                                                <li class="dash-item <?php echo e(( Request::route()->getName() == 'job.create' ? 'active' : '')); ?> ">
                                                    <a class="dash-link" href="<?php echo e(route('job.create')); ?>"><?php echo e(__('Job Create')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                <li class="dash-item <?php echo e((request()->is('job-application*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('job-application.index')); ?>"><?php echo e(__('Job Application')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                <li class="dash-item <?php echo e((request()->is('candidates-job-applications') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('job.application.candidate')); ?>"><?php echo e(__('Job Candidate')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                <li class="dash-item <?php echo e((request()->is('job-onboard*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('job.on.board')); ?>"><?php echo e(__('Job On-boarding')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage custom question')): ?>
                                                <li class="dash-item  <?php echo e((request()->is('custom-question*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('custom-question.index')); ?>"><?php echo e(__('Custom Question')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show interview schedule')): ?>
                                                <li class="dash-item <?php echo e((request()->is('interview-schedule*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('interview-schedule.index')); ?>"><?php echo e(__('Interview Schedule')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show career')): ?>
                                                <li class="dash-item <?php echo e((request()->is('career*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('career',[\Auth::user()->creatorId(),'en'])); ?>"><?php echo e(__('Career')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>

                                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'holiday' || Request::segment(1) == 'policies' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement') ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('HR Admin Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage award')): ?>
                                                <li class="dash-item <?php echo e((request()->is('award*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('award.index')); ?>"><?php echo e(__('Award')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transfer')): ?>
                                                <li class="dash-item  <?php echo e((request()->is('transfer*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage resignation')): ?>
                                                <li class="dash-item <?php echo e((request()->is('resignation*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('resignation.index')); ?>"><?php echo e(__('Resignation')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage travel')): ?>
                                                <li class="dash-item <?php echo e((request()->is('travel*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('travel.index')); ?>"><?php echo e(__('Trip')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage promotion')): ?>
                                                <li class="dash-item <?php echo e((request()->is('promotion*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('promotion.index')); ?>"><?php echo e(__('Promotion')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage complaint')): ?>
                                                <li class="dash-item <?php echo e((request()->is('complaint*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('complaint.index')); ?>"><?php echo e(__('Complaints')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage warning')): ?>
                                                <li class="dash-item <?php echo e((request()->is('warning*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('warning.index')); ?>"><?php echo e(__('Warning')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage termination')): ?>
                                                <li class="dash-item <?php echo e((request()->is('termination*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('termination.index')); ?>"><?php echo e(__('Termination')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage announcement')): ?>
                                                <li class="dash-item <?php echo e((request()->is('announcement*') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('announcement.index')); ?>"><?php echo e(__('Announcement')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage holiday')): ?>
                                                <li class="dash-item <?php echo e((request()->is('holiday*') || request()->is('holiday-calender') ? 'active' : '')); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('holiday.index')); ?>"><?php echo e(__('Holidays')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage event')): ?>
                                        <li class="dash-item <?php echo e((request()->is('event*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('event.index')); ?>"><?php echo e(__('Event Setup')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage meeting')): ?>
                                        <li class="dash-item <?php echo e((request()->is('meeting*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('meeting.index')); ?>"><?php echo e(__('Meeting')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage assets')): ?>
                                        <li class="dash-item <?php echo e((request()->is('account-assets*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('account-assets.index')); ?>"><?php echo e(__('Employees Asset Setup ')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage document')): ?>
                                        <li class="dash-item <?php echo e((request()->is('document-upload*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('document-upload.index')); ?>"><?php echo e(__('Document Setup')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage company policy')): ?>
                                        <li class="dash-item <?php echo e((request()->is('company-policy*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('company-policy.index')); ?>"><?php echo e(__('Company policy')); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="dash-item <?php echo e((Request::segment(1) == 'leavetype' || Request::segment(1) == 'document' || Request::segment(1) == 'performanceType' || Request::segment(1) == 'branch' || Request::segment(1) == 'department'
                                                                    || Request::segment(1) == 'designation' || Request::segment(1) == 'job-stage'|| Request::segment(1) == 'performanceType'  || Request::segment(1) == 'job-category' || Request::segment(1) == 'terminationtype' ||
                                                                Request::segment(1) == 'awardtype' || Request::segment(1) == 'trainingtype' || Request::segment(1) == 'goaltype' || Request::segment(1) == 'paysliptype' ||
                                                                 Request::segment(1) == 'allowanceoption' || Request::segment(1) == 'loanoption' || Request::segment(1) == 'deductionoption') ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('branch.index')); ?>"><?php echo e(__('HRM System Setup')); ?></a>
                                    </li>


                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                    
                                    
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?> -->

                <!--------------------- End HRM ----------------------------------->

                    <!--------------------- Start Account ----------------------------------->

                     <?php if(\Auth::user()->show_account() == 1): ?>
                        <?php if( Gate::check('manage customer') || Gate::check('manage vender')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::route()->getName() == 'print-setting' || Request::segment(1) == 'customer' || Request::segment(1) == 'vender' || Request::segment(1) == 'proposal' || Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer' || Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note' || Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' ||
                                    Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' || (Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance' || Request::segment(1) == 'goal' || Request::segment(1) == 'budget'|| Request::segment(1) ==
                                    'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance' || Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')?' active dash-trigger':''); ?>">
                                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-box"></i></span><span class="dash-mtext"><?php echo e(__('Accounting System ')); ?></span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="dash-submenu">
                                    <?php if(Gate::check('manage customer')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'customer')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Customer')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage vender')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'vender')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('vender.index')); ?>"><?php echo e(__('Vendor')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage proposal')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'proposal')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('proposal.index')); ?>"><?php echo e(__('Proposal')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( Gate::check('manage bank account') ||  Gate::check('manage bank transfer')): ?>
                                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer')? 'active dash-trigger' :''); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Banking')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('bank-account.index')); ?>"><?php echo e(__('Account')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'bank-transfer.index' || Request::route()->getName() == 'bank-transfer.create' || Request::route()->getName() == 'bank-transfer.edit') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('bank-transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( Gate::check('manage invoice') ||  Gate::check('manage revenue') ||  Gate::check('manage credit note')): ?>
                                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')? 'active dash-trigger' :''); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Income')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('invoice.index')); ?>"><?php echo e(__('Invoice')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('revenue.index')); ?>"><?php echo e(__('Revenue')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'credit.note' ) ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('credit.note')); ?>"><?php echo e(__('Credit Note')); ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( Gate::check('manage bill')  ||  Gate::check('manage payment') ||  Gate::check('manage debit note')): ?>
                                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note')? 'active dash-trigger' :''); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Expense')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'bill.index' || Request::route()->getName() == 'bill.create' || Request::route()->getName() == 'bill.edit' || Request::route()->getName() == 'bill.show') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('bill.index')); ?>"><?php echo e(__('Bill')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'payment.index' || Request::route()->getName() == 'payment.create' || Request::route()->getName() == 'payment.edit') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('payment.index')); ?>"><?php echo e(__('Payment')); ?></a>
                                                </li>
                                                <li class="dash-item  <?php echo e((Request::route()->getName() == 'debit.note' ) ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('debit.note')); ?>"><?php echo e(__('Debit Note')); ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if( Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report') ||  Gate::check('ledger report') ||  Gate::check('trial balance report')): ?>
                                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')? 'active dash-trigger' :''); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Double Entry')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'chart-of-account.index') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('chart-of-account.index')); ?>"><?php echo e(__('Chart of Accounts')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'journal-entry.edit' || Request::route()->getName() == 'journal-entry.create' || Request::route()->getName() == 'journal-entry.index' || Request::route()->getName() == 'journal-entry.show') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('journal-entry.index')); ?>"><?php echo e(__('Journal Account')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.ledger' ) ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('report.ledger')); ?>"><?php echo e(__('Ledger Summary')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.balance.sheet' ) ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('report.balance.sheet')); ?>"><?php echo e(__('Balance Sheet')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e((Request::route()->getName() == 'trial.balance' ) ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('trial.balance')); ?>"><?php echo e(__('Trial Balance')); ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\Auth::user()->type =='company'): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'budget')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('budget.index')); ?>"><?php echo e(__('Budget Planner')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage goal')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'goal')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('goal.index')); ?>"><?php echo e(__('Financial Goal')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage constant tax') || Gate::check('manage constant category') ||Gate::check('manage constant unit') ||Gate::check('manage constant payment method') ||Gate::check('manage constant custom field') ): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'active dash-trigger' :''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('taxes.index')); ?>"><?php echo e(__('Accounting Setup')); ?></a>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                            
                                        </li>
                                    <?php endif; ?>

                                    <?php if(Gate::check('manage print settings')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'print-setting') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('print.setting')); ?>"><?php echo e(__('Print Settings')); ?></a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?> 

                <!--------------------- End Account ----------------------------------->

                    <!--------------------- Start CRM ----------------------------------->

                    <!-- <?php if(\Auth::user()->show_crm() == 1): ?>
                        <?php if( Gate::check('manage lead') || Gate::check('manage deal') || Gate::check('manage form builder')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response')?' active dash-trigger':''); ?>">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                                    ><span class="dash-mtext"><?php echo e(__('CRM System')); ?></span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''); ?>">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('leads.index')); ?>"><?php echo e(__('Leads')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage deal')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'deals.list' || Request::route()->getName() == 'deals.index' || Request::route()->getName() == 'deals.show') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('deals.index')); ?>"><?php echo e(__('Deals')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage form builder')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response')?'active open':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('form_builder.index')); ?>"><?php echo e(__('Form Builder')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\Auth::user()->type=='company' || \Auth::user()->type=='client'): ?>
                                        <li class="dash-item  <?php echo e((Request::segment(1) == 'contract')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('contract.index')); ?>"><?php echo e(__('Contract')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage lead stage') || Gate::check('manage pipeline') ||Gate::check('manage source') ||Gate::check('manage label') || Gate::check('manage stage')): ?>
                                        <li class="dash-item  <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')? 'active dash-trigger' :''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('pipelines.index')); ?>   "><?php echo e(__('CRM System Setup')); ?></a>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?> -->

                <!--------------------- End CRM ----------------------------------->

                    <!--------------------- Start Project ----------------------------------->

                    <!-- <?php if(\Auth::user()->show_project() == 1): ?>
                        <?php if( Gate::check('manage project')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e(( Request::segment(1) == 'project' || Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'project' || Request::segment(1) == 'projects')
                            ? 'active dash-trigger' : ''); ?>">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-share"></i></span
                                    ><span class="dash-mtext"><?php echo e(__('Patient System')); ?></span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
                                        <li class="dash-item  <?php echo e(Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Patients')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                                        <li class="dash-item <?php echo e((request()->is('taskboard*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('taskBoard.view', 'list')); ?>"><?php echo e(__('Tasks')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage timesheet')): ?>
                                        <li class="dash-item <?php echo e((request()->is('timesheet-list*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('timesheet.list')); ?>"><?php echo e(__('Timesheet')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
                                        <li class="dash-item <?php echo e((request()->is('bugs-report*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('bugs.view','list')); ?>"><?php echo e(__('Bug')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                                        <li class="dash-item <?php echo e((request()->is('calendar*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('task.calendar',['all'])); ?>"><?php echo e(__('Task Calender')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\Auth::user()->type!='super admin'): ?>
                                        <li class="dash-item  <?php echo e((Request::segment(1) == 'time-tracker')?'active open':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('time.tracker')); ?>"><?php echo e(__('Tracker')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage project task stage') || Gate::check('manage bug status')): ?>
                                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages') ? 'active dash-trigger' : ''); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Project System Setup')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task stage')): ?>
                                                    <li class="dash-item  <?php echo e((Request::route()->getName() == 'project-task-stages.index') ? 'active' : ''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('project-task-stages.index')); ?>"><?php echo e(__('Project Task Stages')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug status')): ?>
                                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'bugstatus.index') ? 'active' : ''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('bugstatus.index')); ?>"><?php echo e(__('Bug Status')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?> -->

                <!--------------------- End Project ----------------------------------->



                    <!--------------------- Start User Managaement System ----------------------------------->

                    <?php if(\Auth::user()->type!='super admin' && ( Gate::check('manage user') || Gate::check('manage role'))): ?>
                        <li class="dash-item dash-hasmenu">
                            <a href="#!" class="dash-link <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'clients')?' active dash-trigger':''); ?>"
                            ><span class="dash-micon"><i class="ti ti-users"></i></span
                                ><span class="dash-mtext"><?php echo e(__('User Management')); ?></span
                                ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                ></a>
                            <ul class="dash-submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : ''); ?> ">
                                        <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage client')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit') ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('clients.index')); ?>"><?php echo e(__('Client')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                <!--------------------- End User Managaement System----------------------------------->


                    <!--------------------- Start Products System ----------------------------------->
                    <?php if(\Auth::user()->type == 'Intern' &&  \Auth::user()->acount == 'Walmart'): ?>
                        <!-- Walmart products start -->
                        <?php if( Gate::check('manage walmart product & service') || Gate::check('manage walmart product & service')): ?>
                            <li class="dash-item dash-hasmenu">
                                <a href="#!" class="dash-link ">
                                    <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext"><?php echo e(__('Walmart Product')); ?></span><span class="dash-arrow">
                                            <i data-feather="chevron-right"></i></span>
                                </a>
                                
                                <ul class="dash-submenu">
                                    <?php
                                    $type = "Walmart";
                                    ?>
                                    <?php if(Gate::check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'amazon')?'active':''); ?>">
                                            <a href="<?php echo e(route('productservicetype.index',$type)); ?>" class="dash-link"><?php echo e(__('Product & Services')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productdisapproved')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('prod.disaprove',$type)); ?>"><?php echo e(__('Disapproved Products')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product & service')): ?>
                                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'amzproductpurchase' || Request::segment(1) == 'amzproductnotpurchase' ) ? 'active dash-trigger' : ''); ?>" href="#hr-report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'amzproductpurchase' || Request::segment(1) == 'amzproductnotpurchase') ? 'true' : 'false'); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Need to Purchase')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <li class="dash-item <?php echo e(request()->is('amzproductpurchase') ? 'active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.purchase',$type)); ?>"><?php echo e(__('Purchased Products')); ?></a>
                                                </li>
                                                <li class="dash-item <?php echo e(request()->is('amzproductnotpurchase') ? 'active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.aprove',$type)); ?>"><?php echo e(__('Not Purchased Products')); ?></a>
                                                </li>

                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('prod.recive',$type)); ?>"><?php echo e(__('Recieved Products')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productinvoice')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('prod.invoice',$type)); ?>"><?php echo e(__('Invoiced Products')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productship')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('prod.ship',$type)); ?>"><?php echo e(__('Shipped Products')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productreturn')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('prod.return',$type)); ?>"><?php echo e(__('Returned Products')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    
                                </ul>
                            </li>
                        <?php endif; ?>
                        <!-- walmart product end -->
                    <?php elseif(\Auth::user()->type == 'Intern' &&  \Auth::user()->acount == 'Amazon'): ?>
                        <!-- Amazon product start --> 
                        <?php if( Gate::check('manage amazon product & service') || Gate::check('manage amazon product & service')): ?>
                            <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link ">
                                       <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext"><?php echo e(__('Amazon Products')); ?></span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                                    </a>
                                        <ul class="dash-submenu">
                                            <?php
                                            $type = "Amazon";
                                            ?>
                                            <?php if(Gate::check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'amazon')?'active':''); ?>">
                                                    <a href="<?php echo e(route('productservicetype.index',$type)); ?>" class="dash-link"><?php echo e(__('Product & Services')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productdisapproved')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.disaprove',$type)); ?>"><?php echo e(__('Disapproved Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'productpurchase' || Request::segment(1) == 'productnotpurchase' ) ? 'active dash-trigger' : ''); ?>" href="#hr-report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'productpurchase' || Request::segment(1) == 'productnotpurchase') ? 'true' : 'false'); ?>">
                                                    <a class="dash-link" href="#"><?php echo e(__('Need to Purchase')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                    <ul class="dash-submenu">
                                                        <li class="dash-item <?php echo e(request()->is('productpurchase') ? 'active' : ''); ?>">
                                                            <a class="dash-link" href="<?php echo e(route('prod.purchase',$type)); ?>"><?php echo e(__('Purchased Products')); ?></a>
                                                        </li>
                                                        <li class="dash-item <?php echo e(request()->is('productnotpurchase') ? 'active' : ''); ?>">
                                                            <a class="dash-link" href="<?php echo e(route('prod.aprove',$type)); ?>"><?php echo e(__('Not Purchased Products')); ?></a>
                                                        </li>

                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                          
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.recive',$type)); ?>"><?php echo e(__('Recieved Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.invoice',$type)); ?>"><?php echo e(__('Invoiced Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.ship',$type)); ?>"><?php echo e(__('Shipped Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                         
                                        </ul>
                                    </li>
                        <?php endif; ?>
                        <!-- Amazon product end --> 
                    <?php else: ?>
                        <?php if( Gate::check('manage product & service') || Gate::check('manage product & service')): ?>
                            <li class="dash-item dash-hasmenu">
                                <a href="#!" class="dash-link ">
                                    <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext"><?php echo e(__('Products System')); ?></span><span class="dash-arrow">
                                            <i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="dash-submenu">
                                    <?php if(Gate::check('manage product & service')): ?>
                                            <li class="dash-item <?php echo e((Request::segment(1) == 'productservice')?'active':''); ?>">
                                                <a href="<?php echo e(route('productservice.index')); ?>" class="dash-link"><?php echo e(__('Product & Services')); ?>

                                                </a>
                                            </li>
                                    <?php endif; ?>

                                    <!-- Amazon product start --> 
                                    <?php if( Gate::check('manage amazon product & service') || Gate::check('manage amazon product & service')): ?>
                            <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link ">
                                       <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext"><?php echo e(__('Amazon Products')); ?></span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                                    </a>
                                        <ul class="dash-submenu">
                                            <?php
                                            $type = "Amazon";
                                            ?>
                                            <?php if(Gate::check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'amazon')?'active':''); ?>">
                                                    <a href="<?php echo e(route('productservicetype.index',$type)); ?>" class="dash-link"><?php echo e(__('Product & Services')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productdisapproved')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.disaprove',$type)); ?>"><?php echo e(__('Disapproved Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'productpurchase' || Request::segment(1) == 'productnotpurchase' ) ? 'active dash-trigger' : ''); ?>" href="#hr-report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'productpurchase' || Request::segment(1) == 'productnotpurchase') ? 'true' : 'false'); ?>">
                                                    <a class="dash-link" href="#"><?php echo e(__('Need to Purchase')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                    <ul class="dash-submenu">
                                                        <li class="dash-item <?php echo e(request()->is('productpurchase') ? 'active' : ''); ?>">
                                                            <a class="dash-link" href="<?php echo e(route('prod.purchase',$type)); ?>"><?php echo e(__('Purchased Products')); ?></a>
                                                        </li>
                                                        <li class="dash-item <?php echo e(request()->is('productnotpurchase') ? 'active' : ''); ?>">
                                                            <a class="dash-link" href="<?php echo e(route('prod.aprove',$type)); ?>"><?php echo e(__('Not Purchased Products')); ?></a>
                                                        </li>

                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                          
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.recive',$type)); ?>"><?php echo e(__('Recieved Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.invoice',$type)); ?>"><?php echo e(__('Invoiced Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage amazon product & service')): ?>
                                                <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('prod.ship',$type)); ?>"><?php echo e(__('Shipped Products')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                         
                                        </ul>
                                    </li>
                        <?php endif; ?>
                                    <!-- Amazon product end --> 

                                    <!-- Walmart products start -->
                                    <?php if( Gate::check('manage walmart product & service') || Gate::check('manage walmart product & service')): ?>
                                        <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="#"><?php echo e(__('Walmart Product')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <?php
                                                $type = "Walmart";
                                                ?>
                                                <?php if(Gate::check('manage walmart product & service')): ?>
                                                    <li class="dash-item <?php echo e((Request::segment(1) == 'amazon')?'active':''); ?>">
                                                        <a href="<?php echo e(route('productservicetype.index',$type)); ?>" class="dash-link"><?php echo e(__('Product & Services')); ?>

                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage walmart product & service')): ?>
                                                    <li class="dash-item <?php echo e((Request::segment(1) == 'productdisapproved')?'active':''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('prod.disaprove',$type)); ?>"><?php echo e(__('Disapproved Products')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage walmart product & service')): ?>
                                                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'amzproductpurchase' || Request::segment(1) == 'amzproductnotpurchase' ) ? 'active dash-trigger' : ''); ?>" href="#hr-report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'amzproductpurchase' || Request::segment(1) == 'amzproductnotpurchase') ? 'true' : 'false'); ?>">
                                                        <a class="dash-link" href="#"><?php echo e(__('Need to Purchase')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                        <ul class="dash-submenu">
                                                            <li class="dash-item <?php echo e(request()->is('amzproductpurchase') ? 'active' : ''); ?>">
                                                                <a class="dash-link" href="<?php echo e(route('prod.purchase',$type)); ?>"><?php echo e(__('Purchased Products')); ?></a>
                                                            </li>
                                                            <li class="dash-item <?php echo e(request()->is('amzproductnotpurchase') ? 'active' : ''); ?>">
                                                                <a class="dash-link" href="<?php echo e(route('prod.aprove',$type)); ?>"><?php echo e(__('Not Purchased Products')); ?></a>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage walmart product & service')): ?>
                                                    <li class="dash-item <?php echo e((Request::segment(1) == 'productrecived')?'active':''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('prod.recive',$type)); ?>"><?php echo e(__('Recieved Products')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage walmart product & service')): ?>
                                                    <li class="dash-item <?php echo e((Request::segment(1) == 'productinvoice')?'active':''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('prod.invoice',$type)); ?>"><?php echo e(__('Invoiced Products')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage walmart product & service')): ?>
                                                    <li class="dash-item <?php echo e((Request::segment(1) == 'productship')?'active':''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('prod.ship',$type)); ?>"><?php echo e(__('Shipped Products')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage walmart product & service')): ?>
                                                    <li class="dash-item <?php echo e((Request::segment(1) == 'productreturn')?'active':''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('prod.return',$type)); ?>"><?php echo e(__('Returned Products')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                                
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <!-- walmart product end -->
                                    <?php if(Gate::check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productstock')?'active':''); ?>">
                                            <a href="<?php echo e(route('productstock.index')); ?>" class="dash-link"><?php echo e(__('Product Stock')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Gate::check('manage product & service')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'productstock')?'active':''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('acounts.index')); ?>"><?php echo e(__('Product Setup')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                <!--------------------- End Products System ----------------------------------->




                    <?php if(\Auth::user()->type!='super admin'): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'support')?'active':''); ?>">
                            <a href="<?php echo e(route('support.index')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext"><?php echo e(__('Support System')); ?></span>
                            </a>
                        </li>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'zoom-meeting')?'active':''); ?>">
                            <a href="<?php echo e(route('zoom-meeting.index')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-user-check"></i></span><span class="dash-mtext"><?php echo e(__('Zoom Meeting')); ?></span>
                            </a>
                        </li>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'chats')?'active':''); ?>">
                            <a href="<?php echo e(url('chats')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-message-circle"></i></span><span class="dash-mtext"><?php echo e(__('Messenger')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                <!--------------------- Start System Setup ----------------------------------->

                    <?php if( Gate::check('manage company plan') || Gate::check('manage order') || Gate::check('manage company settings')): ?>
                        <li class="dash-item dash-hasmenu">
                            <a href="#!" class="dash-link ">
                                <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext"><?php echo e(__('System Setup')); ?></span><span class="dash-arrow">
                                        <i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="dash-submenu">
                                <?php if(Gate::check('manage company settings')): ?>
                                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'company-setting') ? ' active' : ''); ?>">
                                        <a href="<?php echo e(route('company.setting')); ?>" class="dash-link"><?php echo e(__('System Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                <?php endif; ?>

                <!--------------------- End System Setup ----------------------------------->



                </ul>
            <?php endif; ?>
            <?php if((\Auth::user()->type == 'client')): ?>
                <ul class="dash-navbar">
                    <?php if(Gate::check('manage client dashboard')): ?>

                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'dashboard') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('client.dashboard.view')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                            </a>
                        </li>

                    <?php endif; ?>

                    <?php if(Gate::check('manage deal')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'deals') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('deals.index')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-rocket"></i></span><span class="dash-mtext"><?php echo e(__('Deals')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage project')): ?>
                        <li class="dash-item dash-hasmenu  <?php echo e((Request::segment(1) == 'projects') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('projects.index')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-share"></i></span><span class="dash-mtext"><?php echo e(__('Project')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage project task')): ?>
                        <li class="dash-item dash-hasmenu  <?php echo e((Request::segment(1) == 'taskboard') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-list-check"></i></span><span class="dash-mtext"><?php echo e(__('Tasks')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage bug report')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bugs-report') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('bugs.view','list')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-bug"></i></span><span class="dash-mtext"><?php echo e(__('Bugs')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage timesheet')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'timesheet-list') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('timesheet.list')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-clock"></i></span><span class="dash-mtext"><?php echo e(__('Timesheet')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage project task')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'calendar') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('task.calendar',['all'])); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-calendar"></i></span><span class="dash-mtext"><?php echo e(__('Task Calender')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="dash-item dash-hasmenu">
                        <a href="<?php echo e(route('support.index')); ?>" class="dash-link <?php echo e((Request::segment(1) == 'support')?'active':''); ?>">
                            <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext"><?php echo e(__('Support')); ?></span>
                        </a>
                    </li>

                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\product\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>