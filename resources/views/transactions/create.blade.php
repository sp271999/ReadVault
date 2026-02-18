{{-- resources/views/transactions/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">📚 Borrow a Book</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Select Book</label>
                <select name="book_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="">-- Select a Book --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">
                            {{ $book->title }} ({{ $book->available_copies }} left)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Borrow Date</label>
                <input type="date" name="borrowed_at" 
                       value="{{ now()->format('Y-m-d') }}" 
                       class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Return Due Date</label>
                <input type="date" name="due_date" 
                       value="{{ now()->addDays(7)->format('Y-m-d') }}" 
                       class="w-full border-gray-300 rounded-lg shadow-sm" required>
                <p class="text-sm text-gray-500 mt-1">
                    Please return the book within 7 days to avoid penalties.
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-black px-5 py-2 rounded-lg">
                    Borrow Book
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
