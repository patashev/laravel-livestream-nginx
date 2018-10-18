<h2 class="hidden">Header</h2>
<header class="main-header">
    <h3 class="hidden">Logo</h3>
    <a href="/" class="logo">
        <span class="logo-mini"><img src="/images/logo-mini.png" style="width: 100%;"/></span>
        <span class="logo-lg"><img src="/images/logo.png" style="width: 100%;"/></span>
    </a>

    <h3 class="hidden">Header Top Actions</h3>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if(impersonate()->isActive()): ?>
                    <li>
                        <a href="<?php echo e(route('impersonate.logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('impersonate-logout-form').submit();">
                            Return to original user
                        </a>

                        <form id="impersonate-logout-form" action="<?php echo e(route('impersonate.logout')); ?>" method="post" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </li>
                <?php endif; ?>

                <li class="dropdown messages-menu">
                    <a id="js-notifications" href="#" class="dropdown-toggle" data-toggle="modal" data-target="#modal-notifications">
                        <i class="fa fa-envelope-o"></i>
                        <span data-user="<?php echo e(user()->id); ?>" id="js-notifications-badge" class="label label-success" style="display: none;"></span>
                    </a>
                </li>

                <li class="dropdown messages-menu">
                    <a data-type="activities" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span id="js-activities-badge" class="label label-warning" style="display: none;"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul id="js-activities-list" class="menu">

                            </ul>
                        </li>
                        <li class="footer"><a href="/admin/history/website">See All Activities</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(profile_image()); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo user()->fullname; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(profile_image()); ?>" class="img-circle" alt="User Image">
                            <p>
                                <?php echo user()->fullname; ?>

                                <small>Member
                                    since <?php echo e(user()->created_at->format('d F Y')); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo e(url('/admin/profile')); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
