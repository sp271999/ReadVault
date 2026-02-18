

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-8 px-4">
    <!-- Welcome Section -->
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-8">
        <h1 class="text-3xl font-bold text-indigo-700 mb-2">Welcome, <?php echo e(Auth::user()->name); ?> 👋</h1>
      <p class="text-gray-600">
    You are logged in as a
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
        <strong class="text-indigo-600">Admin</strong>
    <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'user')): ?>
        <strong class="text-indigo-600">User</strong>
    <?php else: ?>
        <strong class="text-indigo-600">Member</strong>
    <?php endif; ?>
</p>


        <div class="mt-4 flex flex-wrap gap-3">
            <a href="<?php echo e(route('books.index')); ?>" 
               class="bg-indigo-600 hover:bg-indigo-700 text-black px-5 py-2 rounded-lg transition">
                📚 View All Books
            </a>
            <a href="<?php echo e(route('transactions.index')); ?>" 
               class="bg-gray-700 hover:bg-gray-800 text-black px-5 py-2 rounded-lg transition">
                🧾 My Borrowed Books
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-2xl p-6 mb-8">
        <h2 class="text-xl font-semibold text-indigo-700 mb-4">User Features ✨</h2>
        <ul class="text-gray-700 space-y-2">
            <li>📖 Browse all available books in the library</li>
            <li>📅 Borrow and return books easily</li>
            <li>🧾 Track your borrow history and current transactions</li>
        </ul>
    </div>

    <!-- Books Table Section -->
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">📚 Available Books</h2>

        <?php if($books->isEmpty()): ?>
            <p class="text-center text-gray-500 py-6">No books available at the moment.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">Title</th>
                            <th class="px-4 py-2 text-left text-gray-700">Author</th>
                            <th class="px-4 py-2 text-left text-gray-700">Category</th>
                            <th class="px-4 py-2 text-left text-gray-700">Available Quantity</th>
                            <th class="px-4 py-2 text-center text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-4 py-2"><?php echo e($book->title); ?></td>
                                <td class="px-4 py-2"><?php echo e($book->author); ?></td>
                               <td class="px-4 py-2">
    <?php echo e($book->category->name ?? 'No Category'); ?>

</td>

                                <td class="px-4 py-2"><?php echo e($book->quantity); ?></td>
                                <td class="px-4 py-2 text-center">
                                    <?php if($book->quantity > 0): ?>
                                        <a href="<?php echo e(route('transactions.create', ['book_id' => $book->id])); ?>" 
                                           class="bg-green-600 hover:bg-green-700 text-black px-3 py-1.5 rounded transition">
                                            Borrow
                                        </a>
                                    <?php else: ?>
                                        <span class="text-red-500 font-medium">Out of Stock</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/user/dashboard.blade.php ENDPATH**/ ?>