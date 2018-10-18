<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo e(config('app.author')); ?>">
        <meta name="keywords" content="<?php echo e(config('app.keywords')); ?>">
        <meta name="description" content="<?php echo e(isset($description) ? $description : config('app.description')); ?>"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <meta property="og:type" name="og:type" content="website"/>
        <meta property="og:site_name" content="<?php echo e(config('app.name')); ?>"/>
        <meta property="og:url" name="og:url" content="<?php echo e(request()->url()); ?>"/>
        <meta property="og:caption" name="og:caption" content="<?php echo e(config('app.url')); ?>"/>
        <meta property="fb:app_id" name="fb:app_id" content="<?php echo e(config('app.facebook_id')); ?>"/>
        <meta property="og:title" name="og:title" content="<?php echo e(isset($title) ? $title : config('app.title')); ?>">
        <meta property="og:description" name="og:description" content="<?php echo e(isset($description) ? $description : config('app.description')); ?>">
        <meta property="og:image" name="og:image" content="<?php echo e(config('app.url')); ?><?php echo e(isset($image) ? $image : '/images/logo.png'); ?>">

        <?php echo $__env->make('partials.favicons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <title><?php echo e(isset($title) ? $title : config('app.name')); ?></title>

        <?php if(config('app.env') != 'local'): ?>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <?php endif; ?>

        <link rel="stylesheet" href="/css/website.css?v=2">

        <?php echo $__env->yieldContent('styles'); ?>
        
    </head>

    <body id="top" class="d-flex flex-column align-items-end">
        <h1 class="d-none"><?php echo e(isset($title) ? $title : config('app.name')); ?></h1>

        <?php if(config('app.env') != 'local'): ?>
            <?php echo $__env->make('partials.facebook', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="header">
          <?php echo $__env->make('website.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
          <?php echo $__env->make('website.partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php if(isset($showPageBanner) && $showPageBanner == true || !isset($showPageBanner)): ?>
            <?php echo $__env->make('website.partials.banner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="container mb-5">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <?php echo $__env->make('website.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('website.partials.popups', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
        <a href="#top" class="back-to-top jumper btn btn-secondary">
            <i class="fa fa-angle-up"></i>
        </a>

        <script type="text/javascript" charset="utf-8" src="/js/website.js?v=2"></script>

        <?php echo $__env->yieldContent('scripts'); ?>

        <?php if(config('app.env') != 'local'): ?>
            <?php echo $__env->make('partials.analytics', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </body>
</html>
