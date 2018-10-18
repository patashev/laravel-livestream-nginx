<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>List All Cities</span>
					</h3>
				</div>

				<div class="box-body">

					<?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('admin.partials.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Province</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->title); ?></td>
                                <td><?php echo e($item->latitude); ?></td>
                                <td><?php echo e($item->longitude); ?></td>
                                <td><?php echo $item->province->title; ?></td>
                                <td>
                                    <?php echo action_row($selectedNavigation->url, $item->id, $item->title, ['show', 'edit', 'delete']); ?>

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