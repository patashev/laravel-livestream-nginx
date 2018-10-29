<div class="side d-none d-sm-block col-sm-5 col-lg-4">
    

    <?php if($sidebar != null): ?>

    <style>
        .text-only { background: #fff; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; }
        .currency, .text-only { border: 1px solid #D9D9D9; }
        .text-only .bc { margin: 10px 18px; overflow: hidden; padding: 0 0 10px; }
        .banner, .block { margin: 0 0 10px; }
        .text-left { text-align: left; }
    </style>
      <?php $__currentLoopData = $sidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php switch($val):
          case ($val->sidebar_types_id == '7'): ?>
              <?php echo $__env->make('website.partials.side_news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php break; ?>
          <?php case ($val->sidebar_types_id == '6'): ?>
              <div class="card bg-light">
                  <div class="card-body">
                      <h2 class="side-heading">Popular Links</h2>
                      <ul>
                          <?php $__currentLoopData = $popularPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><a href="<?php echo e($item->url); ?>"><?php echo $item->name; ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                  </div>
              </div>
            <?php break; ?>


          <?php case ($val->sidebar_types_id == '5'): ?>
              <?php echo $__env->make('website.partials.sidebar_moduls.side_weather', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php break; ?>


          <?php case ($val->sidebar_types_id == '2'): ?>
            <?php echo $__env->make('website.partials.sidebar_moduls.side_video_categories', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php break; ?>

        <?php endswitch; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>



    <?php if(Request::is('videos*')): ?>

    <?php else: ?>


    <?php endif; ?>

</div>
