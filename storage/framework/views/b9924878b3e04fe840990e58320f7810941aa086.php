<?php if(session('alert.title')): ?>
    <div class="alert alert-<?php echo e(session('alert.level')); ?> fade in">
        <?php if(session('alert.close')): ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php endif; ?>
        <?php if(session('alert.icon')): ?>
            <i class="fa-fw fa fa-<?php echo e(session('alert.icon')); ?>"></i>
        <?php endif; ?>
        <strong><?php echo e(session('alert.title')); ?></strong>
        <?php echo session('alert.content'); ?>

    </div>
<?php endif; ?>