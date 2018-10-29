<div class="row">
    <?php $__currentLoopData = $paginator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-4">
            <div class="gallery">
                <figure>
                    <?php if($item->cover_photo): ?>
                        <a href="/gallery/<?php echo e($item->slug); ?>" title="<?php echo e($item->cover_photo->name); ?>">

                            <img src="<?php echo e(cdn('/uploads/photos/'.$item->cover_photo->filename)); ?>">
                        </a>
                    <?php endif; ?>
                </figure>
                <h2><?php echo $item->name; ?></h2>
                <p>
                    <a href="/gallery/<?php echo e($item->slug); ?>" class="btn btn-primary btn-block">
                        View gallery
                    </a>
                </p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo $__env->make('website.partials.paginator_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
