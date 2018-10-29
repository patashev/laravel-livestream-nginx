<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Photo Albums</span>
                    </h3>
                </div>

                <div class="box-body">

                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo $__env->make('admin.partials.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Total Photos</th>
                            <th>Cover Photo</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->photos->count()); ?></td>
                                <td>
                                    <?php if($item->cover_photo): ?>
                                        <a target="_blank" href="<?php echo e($item->cover_photo->url); ?>">
                                            <img style="height: 50px;" src="<?php echo e($item->cover_photo->urlForName($item->cover_photo->thumb)); ?>" title="<?php echo e($item->cover_photo->name); ?>">
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                                <td>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <a href="/admin/photos/albums/<?php echo e($item->id); ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="Add Photos to <?php echo e($item->name); ?>">
                                                <i class="fa fa-image"></i>
                                            </a>
                                        </div>
                                        <?php echo action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete'], false); ?>

                                    </div>
                                </td>
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