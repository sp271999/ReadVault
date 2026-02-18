@extends('layouts.app')

@section('content')
    <div class="py-8 max-w-6xl mx-auto px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-2xl p-6">

            <!-- HEADER -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex justify-between items-center">
                Your Borrowed Books

                <div class="flex gap-3">
                    <a href="{{ route('transactions.create') }}"
                        class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Borrow a Book
                    </a>

                    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">
                        Dashboard
                    </a>

                    <a href="{{ route('transactions.pdf') }}"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        📄 Download PDF
                    </a>


                </div>
            </h2>

            <!-- FLASH MESSAGES -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left border-b">ID</th>
                            <th class="px-4 py-2 text-left border-b">Book Title</th>
                            <th class="px-4 py-2 text-left border-b">Borrowed Date</th>
                            <th class="px-4 py-2 text-left border-b">Due Date</th>
                            <th class="px-4 py-2 text-left border-b">Returned Status</th>
                            <th class="px-4 py-2 text-center border-b">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="hover:bg-gray-50">

                                <!-- ID -->
                                <td class="px-4 py-2 border-b">{{ $transaction->id }}</td>

                                <!-- BOOK -->
                                <td class="px-4 py-2 border-b">
                                    {{ $transaction->book->title }}
                                </td>

                                <!-- BORROWED DATE -->
                                <td class="px-4 py-2 border-b">
                                    {{ $transaction->borrowed_at->format('Y-m-d') }}
                                </td>

                                <!-- DUE DATE -->
                                <td class="px-4 py-2 border-b">
                                    {{ $transaction->due_date->format('Y-m-d') }}
                                </td>

                                <!-- RETURN STATUS -->
                                <td class="px-4 py-2 border-b">
                                    @if ($transaction->isReturned())
                                        @if ($transaction->returned_at->gt($transaction->due_date))
                                            <span class="text-red-600 font-semibold">
                                                Returned Late ({{ $transaction->returned_at->format('Y-m-d') }})
                                            </span>
                                        @else
                                            <span class="text-green-600 font-semibold">
                                                Returned ({{ $transaction->returned_at->format('Y-m-d') }})
                                            </span>
                                        @endif
                                    @else
                                        @if ($transaction->isOverdue())
                                            <span class="text-red-600 font-semibold">
                                                Not Returned (Late {{ $transaction->overdueDays() }} days)
                                            </span>
                                        @else
                                            <span class="text-orange-500 font-semibold">
                                                Not Returned
                                            </span>
                                        @endif
                                    @endif
                                </td>

                                <!-- ACTIONS -->
                                <td class="px-4 py-2 border-b text-center">
                                    <div class="flex justify-center gap-3">

                                        <!-- RETURN BUTTON -->
                                        <form action="{{ route('transactions.return', $transaction->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" @if ($transaction->isReturned()) disabled @endif
                                                class="
                                                px-3 py-1 rounded-lg text-black transition
                                                {{ $transaction->isReturned() ? 'bg-gray-300 cursor-not-allowed' : 'bg-green-500 hover:bg-green-600' }}
                                            ">
                                                {{ $transaction->isReturned() ? 'Returned' : 'Return' }}
                                            </button>
                                        </form>

                                        <!-- ADMIN ACTIONS -->
                                        @can('view transactions')
                                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                class="bg-yellow-400 text-black px-3 py-1 rounded-lg hover:bg-yellow-500 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 text-black px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No borrowed books found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
