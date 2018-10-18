<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Cities - <?php echo e($item->title); ?></span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="<?php echo e($item->title); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Province</label>
                                        <input type="text" class="form-control" value="<?php echo e($item->province->title); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <?php echo $__env->make('admin.partials.form_footer', ['submit' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

            initGoogleMapView('map_canvas', latitude, longitude, zoom_level);
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>