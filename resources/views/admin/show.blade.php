@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Role Details</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $role->id }}</p>
            <p><strong>Name:</strong> {{ $role->name }}</p>
            <p><strong>Guard:</strong> {{ $role->guard_name }}</p>
            <p><strong>Created At:</strong> {{ $role->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
            ← Back to Roles
        </a>
    </div>
</div>
@endsection
