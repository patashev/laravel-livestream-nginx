<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Banners</span>
                    </h3>
                </div>

                <div class="box-body">

                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo $__env->make('admin.partials.toolbar', ['order' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Banner</th>
                            <th>Summary</th>
                            <th>Button</th>
                            <th>Active From</th>
                            <th>Active To</th>
                            <th>Image</th>
                            <th>Website</th>
                            <th style="min-width: 100px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->summary); ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo e($item->action_url); ?>"><?php echo e($item->action_name); ?></a>
                                </td>
                                <td><?php echo e(format_date($item->active_from)); ?></td>
                                <td><?php echo e(isset($item->active_to)? format_date($item->active_to):'-'); ?></td>
                                <td><?php echo image_row_link($item->image_thumb, $item->image); ?></td>
                                <td><?php echo e($item->is_website ? 'Yes':'No'); ?></td>
                                <td>
                                    <div class="btn-toolbar">
                                        <a href="/admin/photos/banners/<?php echo e($item->id); ?>/crop-resource" class="btn btn-info btn-xs" data-toggle="tooltip" title="Crop <?php echo e($item->name); ?>">
                                            <i class="fa fa-crop"></i>
                                        </a>
                                        <?php echo action_row($selectedNavigation->url, $item->id, $item->title, ['show', 'edit', 'delete'], false); ?>

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