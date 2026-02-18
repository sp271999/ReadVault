@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Book</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST"~ class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Title</label>
            <input type="text" name="title" class="border rounded w-full p-2" value="{{ old('title', $book->title) }}">
        </div>
        <div>
            <label class="block font-medium">Author</label>
            <input type="text" name="author" class="border rounded w-full p-2" value="{{ old('author', $book->author) }}">
        </div>
        
          <div class="mb-4">
    <label class="block text-sm font-medium">Category</label>

    <select name="category_id"
            class="mt-1 block w-full border rounded p-2"
            required>
        <option value="">-- Select Category --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

        <div>
            <label class="block font-medium">Quantity</label>
            <input type="number" name="quantity" class="border rounded w-full p-2" value="{{ old('quantity', $book->quantity) }}">
        </div>
        
        <div>
            <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded hover:bg-green-600">Update Book</button>
            <a href="{{ route('books.index') }}" class="ml-2 text-gray-700 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
