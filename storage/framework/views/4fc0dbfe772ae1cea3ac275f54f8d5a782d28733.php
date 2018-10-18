<h2 class="d-none">Navigation</h2>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel hide">
            <div class="pull-left image">
                <img src="<?php echo e(profile_image()); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo user()->firstname; ?></p>
                <p><?php echo user()->lastname; ?></p>
            </div>
        </div>

        <nav>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">NAVIGATION</li>
                <?php echo $__env->make('admin.partials.navigation_list', ['collection' => $navigation['root']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
        </nav>
    </section>
</aside>
