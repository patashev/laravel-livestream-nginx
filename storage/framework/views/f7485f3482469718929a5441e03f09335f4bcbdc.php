<?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e($nav->url); ?>" class="dropdown-item">
        <?php if($nav->icon): ?>
            <i class=" fa fa-fw fa-<?php echo e($nav->icon); ?>"></i>
        <?php endif; ?>
        <?php echo $nav->name; ?>

    </a>

    <?php if(isset($navigation[$nav->id])): ?>
        <div class="dropdown-menu" aria-labelledby="<?php echo e($nav->id); ?>">
            <?php echo $__env->make('website.partials.navigation.dropdown', ['collection' => $navigation[$nav->id]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
