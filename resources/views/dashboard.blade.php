@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-bold mb-4">
        Welcome to ReadVault, {{ Auth::user()->name }} 👋
    </h1>

    @role('admin')
        <div class="p-4 bg-red-100 rounded mb-4">
            <h2 class="font-semibold text-lg">Admin Dashboard</h2>
            <p>You have admin access.</p>
        </div>
    @endrole

    @role('user')
        <div class="p-4 bg-green-100 rounded mb-4">
            <h2 class="font-semibold text-lg">User Dashboard</h2>
            <p>You are logged in as a user.</p>
        </div>
    @endrole

</div>
@endsection
