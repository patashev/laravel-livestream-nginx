<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="author" content="<?php echo config('app.author'); ?>">
        <meta name="keywords" content="<?php echo config('app.keywords'); ?>">
        <meta name="description" content="<?php echo e($HTMLDescription); ?>"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php echo $__env->make('partials.favicons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <title><?php echo e($HTMLTitle); ?></title>

        <?php if(config('app.debug') != 'local'): ?>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <?php endif; ?>

        <link rel="stylesheet" href="/css/admin.css?v=1">
        <?php echo $__env->yieldContent('styles'); ?>
    </head>

    <body class="hold-transition skin-black sidebar-mini">
        <h1 class="hidden"><?php echo e(isset($HTMLTitle) ? $HTMLTitle : config('app.name')); ?></h1>

        <div class="wrapper">
            <?php echo $__env->make('admin.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->make('admin.partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="content-wrapper">
                <h2 class="hidden">Breadcrumb</h2>
                <section class="content-header">
                    <?php echo $pagecrumb; ?>


                    <?php echo $breadcrumb; ?>

                </section>

                <section class="content">
                    <h2 class="hidden">Page</h2>
                    <?php echo $__env->yieldContent('content'); ?>
                </section>
            </div>

            <footer class="main-footer">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <small>Copyright &copy; <?php echo e(date('Y')); ?>

                            <strong><?php echo e(config('app.name')); ?></strong>
                        </small>
                    </div>
                    <div class="col-sm-6 text-right">
                        <small>
                            Developed by
                            <a href="https://github.com/bpocallaghan" target="_blank"><?php echo config('app.author'); ?></a>
                        </small>
                    </div>
                </div>
            </footer>
        </div>

        <?php echo $__env->make('notify::notify', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('admin.partials.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <script type="text/javascript" charset="utf-8" src="/js/admin.js?v=1"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                initAdmin();
            });
        </script>

        <?php echo $__env->yieldContent('scripts'); ?>

        <?php if(config('app.env') != 'local'): ?>
            <?php echo $__env->make('partials.analytics', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </body>
</html>
