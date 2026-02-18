

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-6">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Categories</h2>
        <a href="<?php echo e(route('admin.categories.create')); ?>"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Category
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <td class="border p-2"><?php echo e($category->name); ?></td>
                <td class="border p-2">
                    <a href="<?php echo e(route('admin.categories.edit', $category)); ?>"
                       class="bg-yellow-400 px-3 py-1 rounded">Edit</a><br><br>

                    <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                          method="POST" class="inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button onclick="return confirm('Delete?')"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/admin/category/index.blade.php ENDPATH**/ ?>