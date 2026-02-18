<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;




class RegisteredUserController extends Controller
{
    /**
     * Show registration form.
     */
    public function create(): View
    {  
        return view('auth.register');
    }
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Create new user (PASSWORD MUST BE HASHED)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assign default Spatie role
    $user->assignRole('user');  // ✔ Every new user becomes 'user'

    Auth::login($user);

    return redirect()->route('user.dashboard');
}

public function userDashboard()
{
    $books = Book::all(); // ✅ get all books
    return view('user.dashboard', compact('books'));
}
public function index()
{
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    // if ($user->hasRole('user')) {
    //     return redirect()->route('user.dashboard');
    // }

    // fallback safety
   return redirect()->route('user.dashboard');

}



}