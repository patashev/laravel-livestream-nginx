<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span><?php echo e(isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new City'); ?></span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<form method="POST" action="<?php echo e($selectedNavigation->url . (isset($item)? "/{$item->id}" : '')); ?>" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                        <input name="_method" type="hidden" value="<?php echo e(isset($item)? 'PUT':'POST'); ?>">

                        <input name="zoom_level" type="hidden" value="<?php echo e(isset($item)? $item->zoom_level : old('zoom_level')); ?>" readonly/>
                        <input name="latitude" type="hidden" value="<?php echo e(isset($item)? $item->latitude : old('latitude')); ?>" readonly/>
                        <input name="longitude" type="hidden" value="<?php echo e(isset($item)? $item->longitude : old('longitude')); ?>" readonly/>

                        <fieldset>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e(form_error_class('title', $errors)); ?>">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Please insert the Title" value="<?php echo e(($errors && $errors->any()? old('title') : (isset($item)? $item->title : ''))); ?>">
                                        <?php echo form_error_message('title', $errors); ?>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo e(form_error_class('province_id', $errors)); ?>">
                                    	<label for="province">Province</label>
                                    	<?php echo form_select('province_id', ([0 => 'Please select a Province'] + $provinces), ($errors && $errors->any()? old('province_id') : (isset($item)? $item->province_id : '')), ['class' => 'select2 form-control']); ?>

                                    	<?php echo form_error_message('province_id', $errors); ?>

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

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-map-marker"></i></span>
                        <span>Google Map</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <div id="map_canvas" class="google_maps" style="height: 450px;">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(config('app.google_map_key')); ?>"></script>
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            var latitude = <?php echo e(isset($item) && strlen($item->latitude) > 2? $item->latitude : -30); ?>;
            var longitude = <?php echo e(isset($item) && strlen($item->longitude) > 2? $item->longitude : 24); ?>;
            var zoom_level = <?php echo e(isset($item) && strlen($item->zoom_level) >= 1? $item->zoom_level : 6); ?>;

            initGoogleMapEditClean('map_canvas', latitude, longitude, zoom_level);
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>