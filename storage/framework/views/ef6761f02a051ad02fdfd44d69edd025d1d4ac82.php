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
                                  <div class="form-group <?php echo e(form_error_class('cities', $errors)); ?>">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group <?php echo e(form_error_class('cities', $errors)); ?>">
                                              <label for="type">Choose city</label>
                                              <?php echo form_select('cities', ([0 => 'Please select a Type'] + $cities), isset($item)? ($errors && $errors->any()? old('cities') : $item->cities_id) : old('cities'), ['class' => 'select2 form-control ']); ?>

                                              <?php echo form_error_message('cities', $errors); ?>

                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col col-xs-12">
                                    <div class="form-group <?php echo e(form_error_class('date', $errors)); ?>">
                                        <label for="date">Date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date" data-date-format="YYYY-MM-DD" name="date" placeholder="Please insert the Date for forcast" value="<?php echo e(($errors && $errors->any()? old('date') : (isset($item)? $item->date : ''))); ?>">
                                            <span class="input-group-addon" style="margin-left: 5px;font-size: xx-large;">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <?php echo form_error_message('date', $errors); ?>

                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group <?php echo e(form_error_class('weather_type', $errors)); ?>">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group <?php echo e(form_error_class('weather_type', $errors)); ?>">
                                                <label for="weather_type">Choose type</label>
                                                <?php echo form_select('weather_type', ([0 => 'Please select a Type'] + $weather_type), isset($item)? ($errors && $errors->any()? old('weather_type') : $item->weather_type) : old('weather_type'), ['class' => 'select2 form-control ']); ?>

                                                <?php echo form_error_message('weather_type', $errors); ?>

                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group <?php echo e(form_error_class('min-temp', $errors)); ?>">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group <?php echo e(form_error_class('min-temp', $errors)); ?>">
                                                <label for="type">Min temp</label>
                                                <input type="text" class="form-control input-generate-slug" id="min-temp" name="min-temp" placeholder="Please insert min-temp" value="<?php echo e(($errors && $errors->any()? old('min-temp') : (isset($item)? $item->min-temp : ''))); ?>">
                                                <?php echo form_error_message('min-temp', $errors); ?>

                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group <?php echo e(form_error_class('max-temp', $errors)); ?>">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group <?php echo e(form_error_class('max-temp', $errors)); ?>">
                                                <label for="type">Max temp</label>
                                                <input type="text" class="form-control input-generate-slug" id="max-temp" name="max-temp" placeholder="Please insert max-temp" value="<?php echo e(($errors && $errors->any()? old('max-temp') : (isset($item)? $item->max-temp : ''))); ?>">
                                                <?php echo form_error_message('max-temp', $errors); ?>

                                            </div>
                                        </div>
                                      </div>
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
          setDateTimePickerRange('#date');
            //initSidebarableMenu(3, "<?php echo e(request()->url().'/order'); ?>");
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>