<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>List All Tags</span>
					</h3>
				</div>

				<div class="box-body">



					<?php echo $__env->make('admin.partials.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
              <th>City</th>
              <th>Forcast</th>
							<th>Date</th>
              <th width="8%"></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($item->cities->title); ?></td>
                <td><?php echo e($item->weather_types->name); ?></td>
                <td><?php echo e($item->created_at); ?></td>
                <td><img src="/images/<?php echo e($item->weather_types->icon_name); ?>" class="mx-auto text-center d-block" width="100"></td>
								<td><?php echo action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete', 'show']); ?></td>
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