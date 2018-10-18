<style>
.weather .city {
    width: 100px;
    float: left;
    text-align: center;
    color: #999;
}

.city img {

    display: inline-block;
    height: auto !important;
    max-width: 100%;
}
</style>
<div class="card bg-light">
    <div class="card-body block weather">
      <div class="block weather">
        <div class="bh">
          <h5>Времето за 16 октомври 2018</h5>
        </div>
        <div class="bc" style="margin-left:auto; margin-right:auto; width:300px;">

          <?php $__currentLoopData = $weather; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $array[$value->cities->title][$key] = $value; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="city">
                <h5><?php echo e($key); ?></h5>
                <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($item === reset($val)): ?>
                    <div class="today-icon">
                      <img src="/images/<?php echo e($item->weather_types->icon_name); ?>" title="" alt="">
                    </div>
                    <div class="temp">
                      <span class="low"><?php echo e($item['min-temp']); ?>°</span>/<span class="high"><?php echo e($item['max-temp']); ?>°</span>
                    </div>
                  <?php else: ?>
                    <div class="forecast">
                      <span class="day"><?php echo e(\Carbon\Carbon::parse($item->date)->format('D')); ?></span>
                      <span class="low"><?php echo e($item['min-temp']); ?>°</span>/<span class="high"><?php echo e($item['max-temp']); ?>°</span>
                      <span class="icon">
                        <img src="/images/<?php echo e($item->weather_types->icon_name); ?>" title="" alt="" width="30">
                      </span>
                    </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>
