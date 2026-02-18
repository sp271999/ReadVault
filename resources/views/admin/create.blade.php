@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Role</h3><br>

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <div class="mb-3">
            <label>Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div><br>

        <div class="mb-3">
            <label>Guard</label>
            <select name="guard_name" class="form-control">
                <option value="web">web</option>
                <option value="api">api</option>
            </select>
        </div><br>

        <button class="btn btn-success">Create</button><br><br>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
            Back
        </a>
    </form>
</div>
@endsection
