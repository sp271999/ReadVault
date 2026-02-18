@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 🔹 Dashboard Navigation Bar --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <nav class="space-x-4">
                 @role('admin')
                        <a href="{{ route('books.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            + Add Book
                        </a>
                    @endrole

                    <a href="{{ route('books.pdf') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                        Download PDF
                    </a>


                </nav>
            </div>

            {{-- 🔹 All Books Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">All Books</h3>

                {{-- 🔍 Search Box --}}
                <form method="GET" action="{{ route('books.index') }}" class="mb-4">
                    <div class="flex gap-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by title, author or category..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400" />

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            Search
                        </button>

                        <a href="{{ route('books.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>


                <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">Title</th>
                            <th class="px-4 py-2 text-left text-gray-700">Author</th>
                            <th class="px-4 py-2 text-left text-gray-700">Category</th>
                            <th class="px-4 py-2 text-left text-gray-700">Quantity</th>
                            @role('admin')
                                <th class="px-4 py-2 text-left text-gray-700">Actions</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $book->title }}</td>
                                <td class="px-4 py-2">{{ $book->author }}</td>
                                <td class="px-4 py-2">
                                    {{ $book->category->name ?? 'No Category' }}
                                </td>
                                <td class="px-4 py-2">{{ $book->quantity }}</td>
                                @role('admin')
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-black px-3 py-1 rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                @endrole
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                    No books found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
