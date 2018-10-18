<?php if(isset($breadcrumbItems)): ?>
    <?php if($page->id != 1): ?>
        <ol class="breadcrumb bg-light">
            <?php $__currentLoopData = $breadcrumbItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="breadcrumb-item">
                    <?php if(!$loop->last): ?>
                        <a class="text-secondary" href="<?php echo e($item->url); ?>"><?php echo e($item->name); ?></a>
                    <?php else: ?>
                        <span class="text-muted"><?php echo $item->name; ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    <?php endif; ?>
<?php endif; ?>
