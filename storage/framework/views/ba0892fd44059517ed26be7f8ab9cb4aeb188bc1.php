<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-xs-12">
          
        	<?php if(count($errors) > 0): ?>
				<div class="alert alert-danger">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			<?php endif; ?>
            <div class="box box-primary box-solid">
            	<div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Streams</span>
                    </h3>
                </div>
                <div class="box-body">
                	<?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                	<div class="well well-sm well-toolbar">

                        <a class="btn btn-labeled btn-primary" href="<?php echo e(Request::url().'/create'); ?>">
                            <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create <?php echo e(ucfirst($resource)); ?>

                        </a>
                    </div>
                     <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                    <!-- <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%"> -->
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>RTMP Server</th>
                            <th>RTMP Stream Key</th>
                            <th>Date created</th>
                            <th style="min-width: 100px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->title); ?></td>
                                <td><p>rtmp://<?php echo e(request()->server->get('SERVER_NAME')); ?>/live/</p></td>
                                <td><?php echo e($item->slug); ?>?key=<?php echo e($item->key); ?></td>
                                <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                                <td>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                           
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