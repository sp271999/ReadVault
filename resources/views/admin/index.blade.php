@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-6">

        <!-- PAGE HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Roles</h1>
                <p class="text-sm text-gray-500">Manage roles & permissions</p>
            </div>

            <a href="{{ route('admin.roles.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + Create Role
            </a>
        </div>

        <!-- CARD -->
        <div class="bg-white shadow rounded-xl overflow-hidden">

            <!-- CARD HEADER -->
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">Roles List</h2>

                <a href="{{ route('admin.users.list') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-black px-3 py-1.5 rounded text-sm">
                    Users List
                </a>
            </div>

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="px-6 pt-4">
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <!-- SUCCESS -->
            @if (session('success'))
                <div class="px-6 pt-4">
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-gray-50 text-gray-700 uppercase tracking-wide">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Guard</th>
                            <th class="px-6 py-3">Created</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($roles as $role)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $role->id }}</td>
                                <td class="px-6 py-4 font-medium">{{ $role->name }}</td>
                                <td class="px-6 py-4">{{ $role->guard_name }}</td>
                                <td class="px-6 py-4">
                                    {{ $role->created_at->format('d M Y') }}
                                </td>

                                <!-- ACTIONS -->
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-3">

                                        <a href="{{ route('admin.roles.show', $role) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs">
                                            View
                                        </a>

                                        <a href="{{ route('admin.roles.edit', $role) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded text-xs">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.roles.destroy', $role) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this role?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="px-6 py-4 border-t">
                {{ $roles->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
