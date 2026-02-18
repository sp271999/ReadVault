

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">Users & Roles</h1>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <td class="p-2 border"><?php echo e($user->name); ?></td>
                <td class="p-2 border"><?php echo e($user->email); ?></td>
                <td class="p-2 border">
                    <?php echo e($user->roles->pluck('name')->implode(', ')); ?>

                </td>

                <td class="p-2 border">
    
    <?php if($user->hasRole('admin')): ?>
        <span class="text-gray-500 font-semibold">Admin</span>

    
    <?php elseif($user->id === auth()->id()): ?>
        <span class="text-gray-500 font-semibold">Current User</span>

    
    <?php else: ?>
        <form method="POST" action="<?php echo e(route('admin.users.login', $user->id)); ?>">
            <?php echo csrf_field(); ?>
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                Login
            </button>
        </form>
    <?php endif; ?>
</td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/admin/list.blade.php ENDPATH**/ ?>