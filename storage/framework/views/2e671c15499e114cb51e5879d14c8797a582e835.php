<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-md-6">
            <?php echo $__env->make('admin.analytics.partials.devices_category', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div class="col-md-6">
            <?php echo $__env->make('admin.analytics.partials.browsers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $__env->make('admin.analytics.partials.devices', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>