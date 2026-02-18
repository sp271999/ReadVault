

<?php $__env->startSection('content'); ?>
    <div class="py-8 max-w-6xl mx-auto px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-2xl p-6">

            <!-- HEADER -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex justify-between items-center">
                Your Borrowed Books

                <div class="flex gap-3">
                    <a href="<?php echo e(route('transactions.create')); ?>"
                        class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Borrow a Book
                    </a>

                    <a href="<?php echo e(route('dashboard')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">
                        Dashboard
                    </a>

                    <a href="<?php echo e(route('transactions.pdf')); ?>"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        📄 Download PDF
                    </a>


                </div>
            </h2>

            <!-- FLASH MESSAGES -->
            <?php if(session('success')): ?>
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left border-b">ID</th>
                            <th class="px-4 py-2 text-left border-b">Book Title</th>
                            <th class="px-4 py-2 text-left border-b">Borrowed Date</th>
                            <th class="px-4 py-2 text-left border-b">Due Date</th>
                            <th class="px-4 py-2 text-left border-b">Returned Status</th>
                            <th class="px-4 py-2 text-center border-b">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">

                                <!-- ID -->
                                <td class="px-4 py-2 border-b"><?php echo e($transaction->id); ?></td>

                                <!-- BOOK -->
                                <td class="px-4 py-2 border-b">
                                    <?php echo e($transaction->book->title); ?>

                                </td>

                                <!-- BORROWED DATE -->
                                <td class="px-4 py-2 border-b">
                                    <?php echo e($transaction->borrowed_at->format('Y-m-d')); ?>

                                </td>

                                <!-- DUE DATE -->
                                <td class="px-4 py-2 border-b">
                                    <?php echo e($transaction->due_date->format('Y-m-d')); ?>

                                </td>

                                <!-- RETURN STATUS -->
                                <td class="px-4 py-2 border-b">
                                    <?php if($transaction->isReturned()): ?>
                                        <?php if($transaction->returned_at->gt($transaction->due_date)): ?>
                                            <span class="text-red-600 font-semibold">
                                                Returned Late (<?php echo e($transaction->returned_at->format('Y-m-d')); ?>)
                                            </span>
                                        <?php else: ?>
                                            <span class="text-green-600 font-semibold">
                                                Returned (<?php echo e($transaction->returned_at->format('Y-m-d')); ?>)
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if($transaction->isOverdue()): ?>
                                            <span class="text-red-600 font-semibold">
                                                Not Returned (Late <?php echo e($transaction->overdueDays()); ?> days)
                                            </span>
                                        <?php else: ?>
                                            <span class="text-orange-500 font-semibold">
                                                Not Returned
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>

                                <!-- ACTIONS -->
                                <td class="px-4 py-2 border-b text-center">
                                    <div class="flex justify-center gap-3">

                                        <!-- RETURN BUTTON -->
                                        <form action="<?php echo e(route('transactions.return', $transaction->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" <?php if($transaction->isReturned()): ?> disabled <?php endif; ?>
                                                class="
                                                px-3 py-1 rounded-lg text-black transition
                                                <?php echo e($transaction->isReturned() ? 'bg-gray-300 cursor-not-allowed' : 'bg-green-500 hover:bg-green-600'); ?>

                                            ">
                                                <?php echo e($transaction->isReturned() ? 'Returned' : 'Return'); ?>

                                            </button>
                                        </form>

                                        <!-- ADMIN ACTIONS -->
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view transactions')): ?>
                                            <a href="<?php echo e(route('transactions.edit', $transaction->id)); ?>"
                                                class="bg-yellow-400 text-black px-3 py-1 rounded-lg hover:bg-yellow-500 transition">
                                                Edit
                                            </a>

                                            <form action="<?php echo e(route('transactions.destroy', $transaction->id)); ?>" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="bg-red-500 text-black px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No borrowed books found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/transactions/index.blade.php ENDPATH**/ ?>