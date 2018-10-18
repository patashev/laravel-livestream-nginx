<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List Admin Actions</span>
                    </h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tbl-list-activities" data-order-by="0|desc" data-server="false" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>After</th>
                            <th>Before</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($activity->id); ?></td>
                                <td><?php echo e(isset($activity->user)? $activity->user->fullname:'System'); ?></td>
                                <td><?php echo $activity->name; ?></td>
                                <td><?php echo activitiy_after($activity); ?></td>
                                <td><?php echo $activity->before; ?></td>
                                
                                <td><?php echo e($activity->created_at->diffForHumans()); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initDataTables('#tbl-list-activities', {
                'pageLength': 25,
                'columnDefs': [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                ]
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>