@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <h2 class="text-xl font-bold mb-4">Add Category</h2>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <input type="text" name="name"
               class="w-full border p-2 mb-3"
               placeholder="Category name" required><br><br>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>
@endsection
