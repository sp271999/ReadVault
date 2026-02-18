

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Role Details</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>ID:</strong> <?php echo e($role->id); ?></p>
            <p><strong>Name:</strong> <?php echo e($role->name); ?></p>
            <p><strong>Guard:</strong> <?php echo e($role->guard_name); ?></p>
            <p><strong>Created At:</strong> <?php echo e($role->created_at->format('d M Y, h:i A')); ?></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-secondary">
            ← Back to Roles
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/admin/show.blade.php ENDPATH**/ ?>