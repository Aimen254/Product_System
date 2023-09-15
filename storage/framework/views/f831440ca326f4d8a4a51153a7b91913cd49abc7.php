
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>


<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product & Services')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
    
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('productservice.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import product CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('productservice.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="xl" data-url="<?php echo e(route('productservice.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Product')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0"><?php echo e(__('Sale price')); ?></h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-info">
                                            <small><?php echo e($productService->sale_price); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                    <h3 class="m-0"><?php echo e(__('Purchase Cost Exc ST')); ?></h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-primary">
                                        
                                        <small><?php echo e($productService->purchase_price); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0"><?php echo e(__('Source price')); ?></h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-warning">
                                        
                                        <small><?php echo e($productService->sourceprice); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0"><?php echo e(__('Total Profiit')); ?></h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-success">
                                        
                                        <small><?php echo e($productService->profit); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <h3 class="m-0"><?php echo e(__('Net Profit')); ?></h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="theme-avtar bg-secondary">
                                        
                                        <small><?php echo e($productService->netprofit); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> <?php echo e(__('Total Cost Inc. ST')); ?></h5>
                                            <p class="mb-0 text-sm">
                                                <?php echo e($productService->totalcostin); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> <?php echo e(__('Total Cost')); ?></h5>
                                            <p class="mb-0 text-sm">
                                                <?php echo e($productService->totalcost); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> <?php echo e(__('Total Revenue')); ?></h5>
                                            <p class="mb-0 text-sm">
                                                <?php echo e($productService->totlrev); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-block  align-items-center justify-content-between w-100">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="mb-1"> <?php echo e(__('ROI')); ?></h5>
                                            <p class="mb-0 text-sm">
                                                <?php echo e($productService->ROI); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            
                            <h5 class="mb-0"><a class="text-dark" href="#"><?php echo e($productService->name); ?></a></h5>
                        </div>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <div class="col-auto"><span class="badge rounded-pill bg-primary"><?php echo e($productService->purchase); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 justify-content-between">
                            <div class="col-auto"><span class="badge rounded-pill bg-<?php echo e(\App\Models\ProductService::$status_color[$productService->status]); ?>"><?php echo e(__(\App\Models\ProductService::$product_status[$productService->status])); ?></span>
                            </div>
                            <p class="text-muted text-sm mt-3"><?php echo e($productService->description); ?></p>
                        </div>
                        <div class="card mb-0 mt-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0"><?php echo e(__('Source Pack')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->sourcepack); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('Selling Pack')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->selpack); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('QTY to Purchase')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->quantity); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('shipping')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->shipping); ?></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0"><?php echo e(__('Tax')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->tax_id); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('AMZ Unit')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->unit_id); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('Bundle Cost')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->bundlecost); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('FBA Fee')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->fbafee); ?></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0"><?php echo e(__('Ref Fee')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->reffee); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('AMZ Shipment')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->amzship); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('3PL')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->thpl); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('Cost Exl. FBA')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->costexl); ?></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6 class="mb-0"><?php echo e(__('Cost Exl. Ref & FBA')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->costexlfb); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('Order Value')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->orderval); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('ASIN')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->asin); ?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="mb-0"><?php echo e(__('SKU')); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e($productService->sku); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-0 mt-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6 class="mb-0"><?php echo e(Utility::getDateFormated($productService->date)); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__(' Date')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\productsystm\resources\views/productservice/show.blade.php ENDPATH**/ ?>