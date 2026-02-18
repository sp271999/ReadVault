@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Role</h3><br>

    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Role Name</label>
            <input type="text"
                   name="name"
                   value="{{ $role->name }}"
                   class="form-control" required>
        </div><br>

        <div class="mb-3">
            <label>Guard</label>
            <select name="guard_name" class="form-control">
                <option value="web" @selected($role->guard_name=='web')>web</option>
                <option value="api" @selected($role->guard_name=='api')>api</option>
            </select>
        </div><br>

        <button class="btn btn-success">Update</button><br><br>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
            Back
        </a>
    </form>
</div>
@endsection
