<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Photos</span>
                    </h3>
                </div>

                <div class="box-body">

                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?> <?php echo e($item->is_cover? '(Cover)':''); ?></td>
                                <td><?php echo e($item->photoable->name); ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo e($item->url); ?>">
                                        <img style="height: 50px;" src="<?php echo e($item->urlForName($item->thumb)); ?>" title="<?php echo e($item->name); ?>">
                                    </a>
                                </td>
                                <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                                <td><?php echo action_row($selectedNavigation->url, $item->id, $item->name, ['delete']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>