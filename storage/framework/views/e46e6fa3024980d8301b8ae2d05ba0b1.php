<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 ReadVault Dashboard</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <style>
        .sidebar-link {
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background-color: #eff6ff;
            /* blue-50 */
            color: #1d4ed8;
            /* blue-700 */
        }

        .sidebar-active {
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            background-color: #2563eb;
            /* blue-600 */
            color: white;
            font-weight: 600;
        }
    </style>

</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- ================= HEADER ================= -->
    <header class="bg-blue-700 text-white shadow-md">
        <div class="w-full px-6 py-4 flex justify-between items-center">

            <!-- LEFT -->
            <h1 class="text-2xl font-semibold">📚 ReadVault Dashboard</h1>

            <!-- RIGHT -->
            <div class="flex items-center gap-5">

                <span class="text-sm">
                    <?php echo e(Auth::user()->name); ?>

                </span>

                <a href="<?php echo e(route('profile.edit')); ?>" class="bg-blue-600 hover:bg-blue-500 px-3 py-1 rounded text-sm">
                    Profile
                </a>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-red-500 hover:bg-red-400 px-3 py-1 rounded text-sm">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </header>

    <!-- ================= MAIN WRAPPER ================= -->
    <div class="flex flex-1">

        <!-- ================= SIDEBAR ================= -->
        <!-- ================= SIDEBAR ================= -->
        <aside class="w-64 bg-white border-r shadow-sm">
            <nav class="flex flex-col gap-1 p-6 text-gray-800">

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access dashboard')): ?>
                    <a href="<?php echo e(route('dashboard')); ?>"
                        class="<?php echo e(Route::is('dashboard') ? 'sidebar-active' : 'sidebar-link'); ?>">
                        🏠 Dashboard
                    </a>
                <?php endif; ?>

                





                <a href="<?php echo e(route('dashboard')); ?>"
                    class="<?php echo e(Route::is('dashboard') ? 'sidebar-active' : 'sidebar-link'); ?>">
                    🏠 Dashboard
                </a>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view books')): ?>
                    <a href="<?php echo e(route('books.index')); ?>"
                        class="<?php echo e(Route::is('books.index') ? 'sidebar-active' : 'sidebar-link'); ?>">
                        📖 All Books
                    </a>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create books')): ?>
                    <a href="<?php echo e(route('books.create')); ?>"
                        class="<?php echo e(Route::is('books.create') ? 'sidebar-active' : 'sidebar-link'); ?>">
                        ➕ Add Book
                    </a>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view transactions')): ?>
                    <a href="<?php echo e(route('transactions.index')); ?>"
                        class="<?php echo e(Route::is('transactions.index') ? 'sidebar-active' : 'sidebar-link'); ?>">
                        🔄 Transactions
                    </a>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage categories')): ?>
                    <a href="<?php echo e(route('admin.categories.index')); ?>"
                        class="<?php echo e(Route::is('admin.categories.*') ? 'sidebar-active' : 'sidebar-link'); ?>">
                        🗂️ Manage Categories
                    </a>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage roles')): ?>
                    <a href="<?php echo e(route('admin.roles.index')); ?>"
                        class="<?php echo e(Route::is('admin.roles.*') ? 'sidebar-active' : 'sidebar-link'); ?>">
                        🛡️ Roles & Permissions
                    </a>
                <?php endif; ?>

            </nav>
        </aside>


        <!-- ================= CONTENT ================= -->
        <main class="flex-1 bg-gray-50 p-8 overflow-y-auto">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-800 text-white text-center py-3">
        © <?php echo e(date('Y')); ?> <span class="font-semibold">ReadVault</span> | Developed by Shubhangi Gosai
    </footer>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/layouts/app.blade.php ENDPATH**/ ?>