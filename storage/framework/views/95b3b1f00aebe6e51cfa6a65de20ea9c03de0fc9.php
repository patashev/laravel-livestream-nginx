<div class="well well-sm well-toolbar">
    <a class="btn btn-labeled btn-primary" href="<?php echo e(request()->url().'/create'); ?>">
        <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create <?php echo e(ucfirst($resource)); ?>

    </a>

    <?php if(isset($order) && $order === true): ?>
        <a class="btn btn-labeled btn-default text-primary" href="<?php echo e(request()->url().'/order'); ?>">
            <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span><?php echo e(ucfirst($resource)); ?> Order
        </a>
    <?php endif; ?>
</div>
