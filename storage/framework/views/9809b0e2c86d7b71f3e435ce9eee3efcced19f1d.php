<div class="banner-container">
    <h2 class="d-none">Banner</h2>
    <div id="banner-carousel" class="carousel slide banners" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e($k == 0? 'active':''); ?>">
                    <img src="<?php echo e(uploaded_images_url($banner->image)); ?>" class="banner-image"/>
                    <div class="carousel-caption">
                        <?php if(!$banner->hide_name): ?>
                            <h2><?php echo $banner->name; ?></h2>
                        <?php endif; ?>
                        <?php if($banner->summary): ?>
                            <p><?php echo $banner->summary; ?></p>
                        <?php endif; ?>
                        <?php if($banner->action_url): ?>
                            <a class="btn btn-primary" target="_blank" href="<?php echo e($banner->action_url); ?>"><?php echo e($banner->action_name ?: 'read more'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="carousel-control-prev" href="#banner-carousel" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#banner-carousel" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

