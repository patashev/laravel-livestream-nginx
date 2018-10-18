<div class="row pb-3">
    <?php $__currentLoopData = $paginator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6">
            <div class="news">

                <figure>
                    <a href="/videos/<?php echo e($item->id); ?>" title="<?php echo e($item->cover_photo->title); ?>">
                        <img src="<?php echo e($item->cover_photo->thumbUrl); ?>">
                    </a>
                </figure>

                <div class="media mt-2">
                    <div class="media-left mr-2">
                        <div class="date bg-primary mr-2">
                            <?php echo $item->created_at->format('\<\s\t\r\o\n\g\>d\</\s\t\r\o\n\g\> M Y'); ?>

                        </div>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading text-primary" style="font-weight: 550;">
                          <?php echo substr( $item->title, 0, 160 )?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php echo $__env->make('website.partials.paginator_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
