<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 ReadVault Dashboard</title>
    @vite('resources/css/app.css')

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
                    {{ Auth::user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-500 px-3 py-1 rounded text-sm">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
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

                {{-- ================= GENERAL ================= --}}
                @can('access dashboard')
                    <a href="{{ route('dashboard') }}"
                        class="{{ Route::is('dashboard') ? 'sidebar-active' : 'sidebar-link' }}">
                        🏠 Dashboard
                    </a>
                @endcan

                {{-- ================= BOOKS ================= --}}





                <a href="{{ route('dashboard') }}"
                    class="{{ Route::is('dashboard') ? 'sidebar-active' : 'sidebar-link' }}">
                    🏠 Dashboard
                </a>

                @can('view books')
                    <a href="{{ route('books.index') }}"
                        class="{{ Route::is('books.index') ? 'sidebar-active' : 'sidebar-link' }}">
                        📖 All Books
                    </a>
                @endcan

                @can('create books')
                    <a href="{{ route('books.create') }}"
                        class="{{ Route::is('books.create') ? 'sidebar-active' : 'sidebar-link' }}">
                        ➕ Add Book
                    </a>
                @endcan

                {{-- ================= TRANSACTIONS ================= --}}
                @can('view transactions')
                    <a href="{{ route('transactions.index') }}"
                        class="{{ Route::is('transactions.index') ? 'sidebar-active' : 'sidebar-link' }}">
                        🔄 Transactions
                    </a>
                @endcan

                {{-- ================= ADMIN ================= --}}
                @can('manage categories')
                    <a href="{{ route('admin.categories.index') }}"
                        class="{{ Route::is('admin.categories.*') ? 'sidebar-active' : 'sidebar-link' }}">
                        🗂️ Manage Categories
                    </a>
                @endcan

                @can('manage roles')
                    <a href="{{ route('admin.roles.index') }}"
                        class="{{ Route::is('admin.roles.*') ? 'sidebar-active' : 'sidebar-link' }}">
                        🛡️ Roles & Permissions
                    </a>
                @endcan

            </nav>
        </aside>


        <!-- ================= CONTENT ================= -->
        <main class="flex-1 bg-gray-50 p-8 overflow-y-auto">
            @yield('content')
        </main>

    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-800 text-white text-center py-3">
        © {{ date('Y') }} <span class="font-semibold">ReadVault</span> | Developed by Shubhangi Gosai
    </footer>

</body>

</html>
