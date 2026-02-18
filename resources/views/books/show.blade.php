@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Book Details</h2>

    <div class="bg-white shadow rounded p-4">
        <p><strong>Title:</strong> {{ $book->title }}</p>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category }}</p>
        <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('books.index') }}" class="text-blue-500 hover:underline">Back to List</a>
        <a href="{{ route('books.edit', $book->id) }}" class="ml-4 text-green-500 hover:underline">Edit Book</a>
    </div>
</div>
@endsection
