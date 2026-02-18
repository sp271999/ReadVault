<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>📚 ReadVault</title>

    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- ================= HEADER ================= -->
<header class="bg-blue-700 text-white shadow-md">
    <div class="w-full px-6 py-4 flex justify-between items-center">

        <h1 class="text-2xl font-semibold">📚 ReadVault</h1>

        <nav class="flex items-center gap-4">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('dashboard')); ?>"
                   class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm">
                    Dashboard
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"
                   class="hover:underline text-sm">
                    Login
                </a>

                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>"
                       class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm">
                        Register
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>

    </div>
</header>

<!-- ================= HERO SECTION ================= -->
<main class="flex-1 flex items-center justify-center">
    <div class="max-w-6xl w-full px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

        <!-- LEFT CONTENT -->
        <div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">
                Welcome to <span class="text-blue-700">ReadVault</span>
            </h2>

            <p class="text-gray-600 mb-6 text-lg">
                A smart library management system to organize books,
                track borrowing, and manage users efficiently.
            </p>

            <div class="flex gap-4">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>"
                       class="bg-blue-700 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium">
                        Go to Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>"
                       class="bg-blue-700 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium">
                        Get Started
                    </a>
                <?php endif; ?>

                <a href="https://laravel.com/docs" target="_blank"
                   class="border border-blue-700 text-blue-700 hover:bg-blue-50 px-6 py-3 rounded-lg font-medium">
                    Laravel Docs
                </a>
            </div>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="hidden md:flex justify-center">
            <img
                src="https://illustrations.popsy.co/blue/bookshelf.svg"
                alt="Library Illustration"
                class="w-full max-w-md"
            >
        </div>

    </div>
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-gray-800 text-white text-center py-3">
    © <?php echo e(date('Y')); ?> <span class="font-semibold">ReadVault</span> | Developed by Shubhangi Gosai
</footer>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\ReadVault\resources\views/welcome.blade.php ENDPATH**/ ?>