<?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="<?php echo e(array_search_value($nav->id, $selectedNavigationParents) ? 'active menu-open' : ''); ?> <?php echo e(isset($navigation[$nav->id])? 'treeview':''); ?>">
        <a href="<?php echo e(isset($navigation[$nav->id])? '#' : $nav->url); ?>">
            <i class="fa fa-fw fa-<?php echo e($nav->icon); ?>"></i>
            <span><?php echo $nav->title; ?></span>

            <?php if(isset($navigation[$nav->id])): ?>
                <i class="fa fa-angle-left pull-right"></i>
            <?php endif; ?>
        </a>

        <?php if(isset($navigation[$nav->id])): ?>
            <ul class="treeview-menu">
                <?php echo $__env->make('admin.partials.navigation_list', ['collection' => $navigation[$nav->id]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
        <?php endif; ?>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
