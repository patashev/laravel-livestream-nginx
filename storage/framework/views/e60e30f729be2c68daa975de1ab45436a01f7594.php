<div class="row pb-3">
    <?php $__currentLoopData = $paginator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6">
            <div class="news">
                <figure>
                    <a href="/blog/<?php echo e($item->slug); ?>">
                        <img src="<?php echo e($item->cover_photo->thumbUrl); ?>">
                    </a>
                </figure>
                <div class="media mt-2">
                    <div class="media-left">
                        <div class="date bg-secondary mr-2">
                            <?php echo $item->active_from->format('\<\s\t\r\o\n\g\>d\</\s\t\r\o\n\g\> M Y'); ?>

                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading text-primary"><?php echo $item->title; ?></h4>
                        <div class="text limit">
                            <p><?php echo $item->summary; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo $__env->make('website.partials.paginator_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
