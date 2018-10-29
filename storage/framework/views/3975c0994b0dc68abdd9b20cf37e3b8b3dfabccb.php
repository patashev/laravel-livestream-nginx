<?php $__env->startSection('content'); ?>
    <section class="content p-3">
        <?php echo $__env->make('website.partials.page_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                <?php echo $__env->make('website.partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('alert::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                <h2><?php echo e(app('translator')->getFromJson('profile.update_my_information')); ?></h2>

                <div class="row">
                    <div class="col-md-12">
                        <form id="form-member-register" method="POST" action="<?php echo e(request()->url()); ?>" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group <?php echo e(form_error_class('firstname', $errors)); ?>">
                                        <label><?php echo e(app('translator')->getFromJson('profile.firstname')); ?></label>
                                        <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="<?php echo e(($errors->any()? old('firstname') : $user->firstname)); ?>">
                                        <?php echo form_error_message('firstname', $errors); ?>

                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group <?php echo e(form_error_class('lastname', $errors)); ?>">
                                        <label><?php echo e(app('translator')->getFromJson('profile.lastname')); ?></label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="<?php echo e(($errors->any()? old('lastname') : $user->lastname)); ?>">
                                        <?php echo form_error_message('lastname', $errors); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?php echo e(form_error_class('cellphone', $errors)); ?>">
                              <label><?php echo e(app('translator')->getFromJson('profile.cellphone')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Please insert the Cellphone" value="<?php echo e(($errors->any()? old('cellphone') : $user->cellphone)); ?>">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-mobile"></i></span></div>
                                </div>
                                <?php echo form_error_message('cellphone', $errors); ?>

                            </div>

                            <div class="form-group <?php echo e(form_error_class('email', $errors)); ?>">
                                <label><?php echo e(app('translator')->getFromJson('profile.email')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="id-email" name="email" placeholder="Email Address" value="<?php echo e(($errors->any()? old('email') : $user->email)); ?>">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                                </div>
                                <?php echo form_error_message('email', $errors); ?>

                            </div>

                            <div class="form-group <?php echo e(form_error_class('password', $errors)); ?>">
                                <label><?php echo e(app('translator')->getFromJson('profile.password')); ?></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="<?php echo e(old('password')); ?>">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                </div>
                                <?php echo form_error_message('password', $errors); ?>

                            </div>

                            <div class="form-group <?php echo e(form_error_class('password_confirmation', $errors)); ?>">
                              <label><?php echo e(app('translator')->getFromJson('profile.confirm_password')); ?></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="id-password_confirmation" name="password_confirmation" placeholder="<?php echo e(app('translator')->getFromJson('profile.enter_confirm_password')); ?>" value="<?php echo e(old('password_confirmation')); ?>">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                </div>
                                <?php echo form_error_message('password_confirmation', $errors); ?>

                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <label><?php echo e(app('translator')->getFromJson('profile.update')); ?></label>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php echo $__env->make('website.partials.page_side', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>