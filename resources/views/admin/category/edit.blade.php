@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 px-4">

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
        <p class="text-gray-600">Update the category name below.</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Category Form -->
    <div class="bg-white shadow-md rounded-lg p-6 max-w-lg">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Category Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">
                    Category Name
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300"
                       placeholder="Enter category name"
                       required>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-black px-4 py-2 rounded">
                    Update Category
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
