
    <?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\BookController;
    use App\Http\Controllers\TransactionController;
    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\Admin\RoleController;
    
    use  App\Http\Controllers\Admin\CategoryController;
    use  App\Http\Controllers\Admin\DashboardController;



        Route::prefix('admin')
        ->name('admin.') 
        ->middleware(['auth', 'admin.or.impersonating'])
        ->group(function () {
            Route::resource('roles', RoleController::class);
             Route::get('/users', [RoleController::class, 'list'])->name('users.list');
           Route::post('/users/login/{user}', [RoleController::class, 'loginAsUser'])->name('users.login');
           Route::get('create',[CategoryController::class,'create']);
            Route::resource('categories', CategoryController::class)->middleware('permission:manage categories');
             Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        });



    // role route


    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

    // Default landing page
    Route::get('/', function () {
        return view('welcome');
    });

    // Shared dashboard redirection logic — handled once
    Route::get('dashboard', [RegisteredUserController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

    // Profile routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Resource routes
   

Route::get('/books/pdf', [BookController::class, 'downloadPdf'])
     ->name('books.pdf');

    Route::resource('books', BookController::class)->middleware(['auth']);

    Route::get('/transactions/pdf', [TransactionController::class, 'exportPdf'])
    ->name('transactions.pdf');
    Route::resource('transactions', TransactionController::class)->middleware('auth');
    Route::post('/transactions/{transaction}/return',[TransactionController::class, 'returnBook']
)->name('transactions.return');




    Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [RegisteredUserController::class, 'userDashboard'])
            ->name('user.dashboard');
        
    });

    Route::post('/admin/impersonate/stop', [RoleController::class, 'stopImpersonation'])
    ->name('admin.impersonate.stop')
    ->middleware('auth');


    require __DIR__.'/auth.php';
