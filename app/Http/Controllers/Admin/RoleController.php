<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RoleController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth','role:admin']);
}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $roles = Role::where('guard_name', 'web')
                 ->orderBy('id', 'asc')
                 ->paginate(10);
        return view('admin.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('admin.create');
    }

    
    public function store(Request $request)
    {
         {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'guard_name' => 'required|in:web,api',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);

    return view('admin.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //  $role = Role::findOrFail($id);
        return view('admin.edit', compact('role'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, role $role)
    {
         $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'guard_name' => 'required|in:web,api',
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
         if ($role->name === 'admin') {
            return back()->with('error', 'Admin role cannot be deleted');
        }

        $role->delete();

        return back()->with('success', 'Role deleted successfully');
    }

    // Show users with roles
    public function list()
    {
        $users = User::with('roles')->get();
        return view('admin.list', compact('users'));
    }

    // Login as selected user
    // Login as selected user (IMPERSONATION)
public function loginAsUser(User $user)

{
    
    // ✅ If already impersonating → DO NOTHING
    if (session()->has('impersonate_admin_id')) {
        return redirect()->route('user.dashboard');
    }

    // ✅ Only REAL admin can start impersonation
    if (!Auth::user()->hasRole('admin')) {
        abort(403, 'Only admin can impersonate');
    }

    // ❌ Do not impersonate admin
    if ($user->hasRole('admin')) {
        return back()->with('error', 'Cannot impersonate admin');
    }

    // ✅ Save admin ID
    session()->put('impersonate_admin_id', Auth::id());

    // ✅ Login as user
    Auth::login($user);
    

    return redirect()->route('user.dashboard');
}

}