<?php $__env->startSection('content'); ?>
    <div class="row mt-4 body">
        <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 col-sm-offset-2">
            <div class="margin-top-20">
                <?php echo $__env->make('alert::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <h2 class="page-header text-center mb-4">Sign In</h2>

            <form action="/auth/login" accept-charset="UTF-8" method="POST">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>

                <div class="form-group <?php echo e(form_error_class('email', $errors)); ?>">
                    <label>Email Address</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="id-email" name="email" placeholder="Email Address" value="<?php echo e(old('email')); ?>">
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                    </div>
                    <?php echo form_error_message('email', $errors); ?>

                </div>

                <div class="form-group <?php echo e(form_error_class('password', $errors)); ?>">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="<?php echo e(old('password')); ?>">
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                    </div>
                    <?php echo form_error_message('password', $errors); ?>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" checked="checked">
                                <i></i>Stay signed in
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <a class="btn btn-link padding-left-0" href="<?php echo e(route('forgot-password')); ?>">Forgot
                            Password?</a>
                    </div>
                    <div class="col-4 text-right">
                        <button type="submit" class="btn btn-primary btn-flat btn-submit">
                            Sign In
                            <i class="fa fa-sign-in"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>