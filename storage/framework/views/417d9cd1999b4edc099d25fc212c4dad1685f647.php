<?php if($selectedNavigation->{'help_'.$selectedNavigation->mode.'_title'}): ?>
    <div class="callout callout-info callout-help">
        <h4 class="title"><?php echo e($selectedNavigation->{'help_'.$selectedNavigation->mode.'_title'}); ?></h4>
        <p><?php echo $selectedNavigation->{'help_'.$selectedNavigation->mode.'_content'}; ?></p>
    </div>
<?php endif; ?>