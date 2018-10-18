<div class="card bg-light">
    <div class="card-body latest-news">
        <h3 class="side-heading"><?php echo e(app('translator')->getFromJson('videos.categories')); ?></h3>
        <ul>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <?php if(Config::get('app.locale') == 'bg'): ?>
                    <a href="<?php echo e(route('by_video_categories', ['category_id' => $value['id']])); ?>">
                      <?php echo e($value['title_bg']); ?>

                    </a>
                  <?php else: ?>
                    <a href="<?php echo e(route('by_video_categories', ['category_id' => $value['id']])); ?>">
                      <?php echo e($value['title_en']); ?>

                    </a>
                  <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
