

<?php $__env->startSection('content'); ?>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    <?php echo e(__('Dashboard')); ?>

                </h2>
                <nav class="space-x-4">
                 <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                        <a href="<?php echo e(route('books.create')); ?>"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            + Add Book
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('books.pdf')); ?>"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                        Download PDF
                    </a>


                </nav>
            </div>

            
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">All Books</h3>

                
                <form method="GET" action="<?php echo e(route('books.index')); ?>" class="mb-4">
                    <div class="flex gap-3">
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                            placeholder="Search by title, author or category..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400" />

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            Search
                        </button>

                        <a href="<?php echo e(route('books.index')); ?>"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>


                <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">Title</th>
                            <th class="px-4 py-2 text-left text-gray-700">Author</th>
                            <th class="px-4 py-2 text-left text-gray-700">Category</th>
                            <th class="px-4 py-2 text-left text-gray-700">Quantity</th>
                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                <th class="px-4 py-2 text-left text-gray-700">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2"><?php echo e($book->title); ?></td>
                                <td class="px-4 py-2"><?php echo e($book->author); ?></td>
                                <td class="px-4 py-2">
                                    <?php echo e($book->category->name ?? 'No Category'); ?>

                                </td>
                                <td class="px-4 py-2"><?php echo e($book->quantity); ?></td>
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="<?php echo e(route('books.edit', $book->id)); ?>"
                                            class="bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="<?php echo e(route('books.destroy', $book->id)); ?>" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="bg-red-500 text-black px-3 py-1 rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                    No books found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/books/index.blade.php ENDPATH**/ ?>