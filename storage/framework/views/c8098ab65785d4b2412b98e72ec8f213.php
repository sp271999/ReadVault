


<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto py-8 px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">📚 Borrow a Book</h2>

        
        <?php if(session('success')): ?>
            <div class="mb-4 text-green-600 font-medium"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Select Book</label>
                <select name="book_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="">-- Select a Book --</option>
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($book->id); ?>">
                            <?php echo e($book->title); ?> (<?php echo e($book->available_copies); ?> left)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Borrow Date</label>
                <input type="date" name="borrowed_at" 
                       value="<?php echo e(now()->format('Y-m-d')); ?>" 
                       class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Return Due Date</label>
                <input type="date" name="due_date" 
                       value="<?php echo e(now()->addDays(7)->format('Y-m-d')); ?>" 
                       class="w-full border-gray-300 rounded-lg shadow-sm" required>
                <p class="text-sm text-gray-500 mt-1">
                    Please return the book within 7 days to avoid penalties.
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-black px-5 py-2 rounded-lg">
                    Borrow Book
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/transactions/create.blade.php ENDPATH**/ ?>