<?php $__env->startSection('scripts'); ?>
	##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
	<script type="text/javascript" charset="utf-8">
        $(function ()
        {
            <?php if(session('notify.title')): ?>
                $.notify({
                    title: "<?php echo session('notify.title'); ?>",
                    content: "<?php echo session('notify.content'); ?>",
                    level: "<?php echo e(session('notify.level')); ?>",

                    <?php if(session('notify.icon')): ?>
                        icon: "fa fa-<?php echo e(session('notify.icon')); ?>",
                    <?php endif; ?>

                    <?php if(session('notify.iconSmall')): ?>
                        iconSmall: "fa fa-<?php echo e(session('notify.iconSmall')); ?>",
                    <?php endif; ?>

                    <?php if(session('notify.timeout')): ?>
                        timeout: <?php echo e(session('notify.timeout')); ?>,
                    <?php endif; ?>
                });
            <?php endif; ?>
        });
	</script>
<?php $__env->stopSection(); ?>
