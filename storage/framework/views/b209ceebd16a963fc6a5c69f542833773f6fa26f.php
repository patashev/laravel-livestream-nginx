<?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="<?php echo e(array_search_value($nav->id, $activeParents) ? 'active' : ''); ?> <?php echo e(isset($navigation[$nav->id])? 'dropdown':''); ?> <?php if( $nav->parent_id != 0): ?> dropdown-item <?php else: ?> nav-item <?php endif; ?> ">
        <a href="<?php echo e(isset($navigation[$nav->id])? '#' : $nav->url); ?>" <?php if(isset($navigation[$nav->id])): ?> class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="<?php echo e($nav->id); ?>" <?php else: ?> class="nav-link" <?php endif; ?>>
            <?php if($nav->icon): ?>
                <i class="btn fa fa-fw fa-<?php echo e($nav->icon); ?>"></i>
            <?php endif; ?>
            <?php echo $nav->name; ?>

        </a>

        <?php if(isset($navigation[$nav->id])): ?>
            <div class="dropdown-menu" aria-labelledby="<?php echo e($nav->id); ?>">
                <?php echo $__env->make('website.partials.navigation.dropdown', ['collection' => $navigation[$nav->id]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        <?php endif; ?>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(Route::current()->getName() == 'vid'): ?>
  <li class="nav-item" style="display:block; float:left; margin-top: -5px;">
      <a class="nav-link">
        <input type="text" name="customInputTextField" id="customInputTextField" placeholder="Search...">
        <i class="btn fa fa-fw fa-search" aria-hidden="true" id="searchIconButton"></i>
      </a>
  </li>
  <?php endif; ?>
