<div class="container">
    <div class="row p-3 d-flex align-items-center">
        <a href="/" class="logo" title="<?php echo e(config('app.name')); ?>">
            <img src="/images/logo.png">
        </a>

        
        <div class="ml-auto" role="group" aria-label="...">
            
                
            

            <?php if(!\Auth::check()): ?>
                <a href="#" class="btn btn-outline-primary" data-icon="fa-sign-in" data-toggle="modal" data-target="#modal-login">
                    <i class="fa fa-sign-in"></i>
                    <?php echo e(app('translator')->getFromJson('auth.login')); ?>
                </a>
                <a href="/auth/register" class="btn btn-outline-secondary" data-icon="fa-edit">
                    <?php echo e(app('translator')->getFromJson('auth.register')); ?>
                </a>
            <?php else: ?>
                <?php if(\Auth::check() && user()->hasRole('admin')): ?>
                   <a href="/admin" class="btn btn-link"><i class="fa fa-user-secret"></i> Admin</a>
                <?php endif; ?>
            <?php endif; ?>
            <select id="LanguageSwitcher" class="form-control btn btn-outline-dark" style="width:auto;">
                <option value="en" <?php $cuRRlocal = config('app.locale'); echo ($cuRRlocal == 'en' ? "selected" : "") ?>>English</option>
                <div class="dropdown-divider"></div>
                <option value="bg" <?php $cuRRlocal = config('app.locale'); echo ($cuRRlocal == 'bg' ? "selected" : "") ?> >Български</option>
            </select>
        </div>

    </div>
</div>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('#form-search').on('submit', function () {
                var search = $("#form-search input[name='search']").val();
                window.location.href = "https://www.google.com.na/search?q=<?php echo e(config('app.url')); ?>+" + encodeURI(search);
                return false;
            });
        })
    </script>
    <script type="text/javascript" src="<?php echo e(asset('js/locale.js')); ?>"></script>
<?php $__env->stopSection(); ?>
