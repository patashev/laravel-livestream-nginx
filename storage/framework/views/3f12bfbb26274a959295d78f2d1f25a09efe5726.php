<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span><?php echo e(isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Page'); ?></span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    <form method="POST" action="<?php echo e($selectedNavigation->url . (isset($item)? "/{$item->id}" : '')); ?>" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                        <input name="_method" type="hidden" value="<?php echo e(isset($item)? 'PUT':'POST'); ?>">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group <?php echo e(form_error_class('name', $errors)); ?>">
                                        <label for="sidebar_name">Name</label>
                                        <input type="text" class="form-control input-generate-slug" id="sidebar_name" name="sidebar_name" placeholder="Please insert the Name" value="<?php echo e(($errors && $errors->any()? old('name') : (isset($item)? $item->sidebar_name : ''))); ?>">
                                        <?php echo form_error_message('sidebar_name', $errors); ?>

                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                <div class="form-group <?php echo e(form_error_class('name', $errors)); ?>">
                                    <label for="sidebar_type">Type</label>
                                    <input type="text" class="form-control input-generate-slug" id="sidebar_type" name="sidebar_type" placeholder="Please insert the Name" value="<?php echo e(($errors && $errors->any()? old('name') : (isset($item)? $item->sidebar_type : ''))); ?>">
                                    <?php echo form_error_message('sidebar_type', $errors); ?>

                                </div>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col col-12">
                                <div class="form-group <?php echo e(form_error_class('moduls_id', $errors)); ?>">
                                    <label for="moduls_id">List Moduls</label>


                                    <div class="well well-sm well-toolbar" id="nestable-menu">

                                        <button type="button" class="btn btn-labeled btn-default text-primary" data-action="create-new" data-id="<?php echo e((isset($item)) ? $item->id : ''); ?>">
                                            <span class="btn-label"><i class="fa fa-fw fa-plus-circle"></i></span>Create New
                                        </button>
                                    </div>

                                    <?php if(isset($item)): ?>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="dd" id="dd-navigation" style="max-width: 100%">
                                                <?php echo $itemsHtml; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                          </div>

                        </fieldset>
                        <?php echo $__env->make('admin.partials.form_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin.partials.sidebarable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initSidebarableMenu(3, "<?php echo e(request()->url().'/order'); ?>");
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>