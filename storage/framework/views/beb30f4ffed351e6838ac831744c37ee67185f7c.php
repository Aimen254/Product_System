<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('acounts.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'acounts.index' ) ? ' active' : ''); ?>"><?php echo e(__('Acounts')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('warehouse.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'warehouse.index' ) ? 'active' : ''); ?>"><?php echo e(__('Ware House')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\productsystm\resources\views/layouts/product_setup.blade.php ENDPATH**/ ?>