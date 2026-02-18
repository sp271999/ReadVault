@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">Users & Roles</h1>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr class="text-center">
                <td class="p-2 border">{{ $user->name }}</td>
                <td class="p-2 border">{{ $user->email }}</td>
                <td class="p-2 border">
                    {{ $user->roles->pluck('name')->implode(', ') }}
                </td>

                <td class="p-2 border">
    {{-- Do not allow impersonating admin --}}
    @if($user->hasRole('admin'))
        <span class="text-gray-500 font-semibold">Admin</span>

    {{-- Current logged-in user --}}
    @elseif($user->id === auth()->id())
        <span class="text-gray-500 font-semibold">Current User</span>

    {{-- Normal user → can impersonate --}}
    @else
        <form method="POST" action="{{ route('admin.users.login', $user->id) }}">
            @csrf
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                Login
            </button>
        </form>
    @endif
</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
