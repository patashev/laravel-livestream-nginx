<?php $__env->startSection('content'); ?>
    <section class="content p-3">
        <?php echo $__env->make('website.partials.page_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                <?php echo $__env->make('website.partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="pagination-box">
                    <?php echo $__env->make('website.video.pagination', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>

            <?php echo $__env->make('website.partials.page_side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        // $(function () {
        //     new PaginationClass();
        // })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>