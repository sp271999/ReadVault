@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Transaction</h2>

        <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Returned Date</label>
                <input type="date"
                       name="returned_at"
                       value="{{ old('returned_at', $transaction->returned_at) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('transactions.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded">
                   Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
