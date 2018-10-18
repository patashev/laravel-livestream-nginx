<footer class="pt-5 bg-primary text-white mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 text-left">
                <a href="/" class="logo" title="<?php echo e(config('app.name')); ?>">
                    <img src="/images/logo-w.png">
                </a>
                <hr>
                <small>
                    Website by <a href="https://github.com/bpocallaghan" target="_blank"><?php echo env('APP_AUTHOR'); ?></a>
                </small>
            </div>
            <div class="col-sm-8 text-center">
                <div class="row text-left">
                    <ul class="col-sm-4">
                        <?php $__currentLoopData = $footerNavigation['About']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="<?php echo e($loop->first ? 'text-white':'text-grey'); ?>" href="<?php echo e($item->url); ?>"><?php echo $item->name; ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="text-grey" href="/contact-us">Contact Us</a></li>
                    </ul>
                    <ul class="col-sm-4">
                        <li><a class="text-white" href="#">Pages</a></li>
                        <?php $__currentLoopData = $footerNavigation['Pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="text-grey" href="<?php echo e($item->url); ?>"><?php echo $item->name; ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <ul class="col-sm-4">
                        <li><a class="text-white" href="#">Corporate</a></li>
                        <?php $__currentLoopData = $footerNavigation['Corporate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="text-grey" href="<?php echo e($item->url); ?>"><?php echo $item->name; ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3 bg-dark mt-3">
        
        <div class="text-center">
            <a class="text-muted small" href="/privacy-policy">Privacy Policy</a> |
            <a class="text-muted small" href="/terms-and-conditions">Terms and Conditions </a> |
            <a class="text-muted small" href="/faq">FAQs</a>
        </div>
    </div>
</footer>