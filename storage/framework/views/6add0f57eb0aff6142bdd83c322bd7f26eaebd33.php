<?php if($paginator->total() > 0): ?>
    <div class="row paginator-footer">
        <div class="col-md-12 col-lg-6 text-center text-lg-left text-xl-left align-self-center">
            <p class="info-display mb-lg-0 mb-2">
                Showing
                <strong><?php echo e((($paginator->currentPage() - 1) * $paginator->perPage()) + 1); ?></strong>
                to
                <strong><?php echo e($paginator->perPage() * $paginator->currentPage() > $paginator->total()? $paginator->total() : $paginator->perPage() * $paginator->currentPage()); ?></strong>
                of
                <strong><span class="text-primary"><?php echo e($paginator->total()); ?></span></strong>
                entries
                <?php if(isset($paginator->originalEntries) && $paginator->originalEntries != $paginator->total()): ?>
                    <span class="text-muted">
                        (filtered from
                        <strong><?php echo e($paginator->originalEntries); ?></strong>
                        total entries)
                    </span>
                <?php endif; ?>
            </p>
        </div>
        
        <div class="col-md-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
            <?php echo e($paginator->links('pagination::bootstrap-4')); ?>

        </div>
    </div>
<?php endif; ?>
