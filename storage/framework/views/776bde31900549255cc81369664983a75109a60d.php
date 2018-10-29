<?php $__env->startSection('content'); ?>
    <section class="content p-3">
        <?php echo $__env->make('website.partials.page_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                <?php echo $__env->make('website.partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $album->name; ?></h2>
                    </div>
                </div>
                <div class="gallery">
                    <div class="row">
                        <?php $__currentLoopData = $album->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-sm-4 col-lg-3">
                                <figure>
                                    <a href="<?php echo e($item->url); ?>" rel="group" title="<?php echo e($item->name); ?>" data-fancybox="gallery" data-caption="<?php echo e($item->name); ?>">
                                        <img src="<?php echo e($item->thumbUrl); ?>" alt="<?php echo e($item->name); ?>">
                                    </a>
                                    <figcaption><?php echo $item->name; ?></figcaption>
                                </figure>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <?php echo $__env->make('website.partials.page_side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>