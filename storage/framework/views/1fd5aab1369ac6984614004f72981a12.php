

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Transaction</h2>

        <form method="POST" action="<?php echo e(route('transactions.update', $transaction->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Returned Date</label>
                <input type="date"
                       name="returned_at"
                       value="<?php echo e(old('returned_at', $transaction->returned_at)); ?>"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="<?php echo e(route('transactions.index')); ?>"
                   class="px-4 py-2 bg-gray-300 rounded">
                   Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/transactions/edit.blade.php ENDPATH**/ ?>