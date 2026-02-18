@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Categories</h2>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Category
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr class="text-center">
                <td class="border p-2">{{ $category->name }}</td>
                <td class="border p-2">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="bg-yellow-400 px-3 py-1 rounded">Edit</a><br><br>

                    <form action="{{ route('admin.categories.destroy', $category) }}"
                          method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete?')"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
