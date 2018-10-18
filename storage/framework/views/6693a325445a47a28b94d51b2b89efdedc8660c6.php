<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span><?php echo e(isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Sidebar Module'); ?></span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <form method="POST" action='<?php echo e($selectedNavigation->url."/".$sidebar_id."/moduls".(isset($id)? "/".$id : " ")); ?>' accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                        <input name="_method" type="hidden" value="<?php echo e(isset($item)? 'PUT':'POST'); ?>">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group <?php echo e(form_error_class('name', $errors)); ?>">
                                        <label for="sidebar_name">Name</label>
                                        <input type="text" class="form-control input-generate-slug" id="name" name="name" placeholder="Please insert the Title" value="<?php echo e(($errors && $errors->any()? old('name') : (isset($item)? $item->name : ''))); ?>">
                                        <?php echo form_error_message('sidebar_name', $errors); ?>

                                    </div>
                                </div>
                              </div>



                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group <?php echo e(form_error_class('type', $errors)); ?>">
                                    <label for="type">Choose Type</label>
                                    <?php echo form_select('type', ([0 => 'Please select a Type'] + $type), isset($item)? ($errors && $errors->any()? old('type') : $item->sidebar_types_id) : old('type'), ['class' => 'select2 form-control ']); ?>

                                    <?php echo form_error_message('type', $errors); ?>

                                </div>
                              </div>
                            </div>





                            <div class="row invisible" id="cities">
                              <div class="col-md-12">
                                <div class="form-group <?php echo e(form_error_class('cities', $errors)); ?>">
                                    <label for="cities">Choose city</label>
                                    <?php echo form_select('cities', ([0 => 'Please select a Type'] + $cities), isset($item)? ($errors && $errors->any()? old('cities') : $item->cities_id) : old('cities'), ['class' => 'select3 form-control ']); ?>

                                    <?php echo form_error_message('cities', $errors); ?>

                                </div>
                            </div>
                          </div>




                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group <?php echo e(form_error_class('content', $errors)); ?>">
                                      <label for="article-content">Content</label>
                                      <textarea class="form-control" id="content" name="content" rows="18">
                                        <?php echo e(($errors && $errors->any()? old('content') : (isset($item)? $item->content : ''))); ?>

                                      </textarea>
                                      <?php echo form_error_message('content', $errors); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
          $('.select2').on('change', function(){
            if ($( this ).val() == 5) {
              $("#cities").removeClass('invisible');
            }else {
              $("#cities").addClass('invisible');
            }
            console.log($( this ).val());
          });
            //setDateTimePickerRange('#active_from', '#active_to');
            //initSummerNote('.summernote');
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>