<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityChair;
use App\Http\Controllers\CommunityMemberController;
use App\Http\Controllers\PresidnetController;
use App\Http\Controllers\VicePresident;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CommitteeDashboardController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [userController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [userController::class, 'logout'])->middleware('auth')->name('logout');

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Auth::routes();
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');


});

// Committee Dashboard Routes (Chair, Member, President, Vice President)
Route::middleware(['auth'])->group(function () {
    Route::get('/committee/dashboard', [CommitteeDashboardController::class, 'index'])->name('committee.dashboard');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Community Register 
// Route::get('/chair-register', [CommunityChair::class, 'communityChairRegistration']);
// Route::post('/chairregister', [CommunityChair::class, 'chairregister'])->name('chairregister');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Display all Community Chair
    Route::get('/admin/chair', [CommunityChair::class, 'index'])
        ->name('chair'); // THIS IS THE KEY

        // Community Chair Rgister form 
    Route::get('/admin/chair-register', [CommunityChair::class, 'create'])
        ->name('chair-register'); // THIS IS THE KEY

    // Define the POST submission route (if needed, adjust name if necessary)
    Route::post('/admin/chair-register', [CommunityChair::class, 'store'])
        ->name('chair-register.post');

    Route::get('/admin/chair/{user}/edit', [CommunityChair::class, 'edit'])->name('chair.edit');
    Route::put('/admin/chair/{user}', [CommunityChair::class, 'update'])->name('chair.update');
    Route::delete('/admin/chair/{user}', [CommunityChair::class, 'destroy'])->name('chair.destroy');



    Route::get('admin/member',[CommunityMemberController::class,'index'])
    ->name('member');

    Route::get('/admin/member-register', [CommunityMemberController::class, 'create'])
        ->name('member-register'); // THIS IS THE KEY

    // Define the POST submission route (if needed, adjust name if necessary)
    Route::post('/admin/member-register', [CommunityMemberController::class, 'store'])
        ->name('member-register.post');

    Route::get('/admin/member/{user}/edit', [CommunityMemberController::class, 'edit'])->name('member.edit');
    Route::put('/admin/member/{user}', [CommunityMemberController::class, 'update'])->name('member.update');
    Route::delete('/admin/member/{user}', [CommunityMemberController::class, 'destroy'])->name('member.destroy');


    Route::get('/admin/presidnet', [PresidnetController::class, 'index'])
        ->name('presidnet'); // THIS IS THE KEY
          Route::get('/admin/presidnet-register', [PresidnetController::class, 'create'])
        ->name('presidnet-register'); // THIS IS THE KEY
         Route::post('/admin/presidnet-register', [PresidnetController::class, 'store'])
        ->name('presidnet-register.post');
         Route::get('/admin/presidnet/{user}/edit', [PresidnetController::class, 'edit'])
        ->name('presidnet.edit');
         Route::put('/admin/presidnet/{user}', [PresidnetController::class, 'update'])
        ->name('presidnet.update');
        Route::delete('/admin/presidnet/{user}', [PresidnetController::class, 'destroy'])->name('presidnet.destroy');


        Route::get('/admin/vice-president', [VicePresident::class,'index'])->name('vicepresident');
        Route::get('/admin/vicepresident-register', [VicePresident::class,'create'])->name('vicepresident-register');
        Route::post('/admin/vicepresident-register', [VicePresident::class,'store'])->name('vicepresident-register');
        Route::get('/admin/vicepresident/{user}/edit', [VicePresident::class,'edit'])
        ->name('vicepresident.edit');
        Route::put('/admin/vicepresident/{user}', [VicePresident::class,'update'])
        ->name('vicepresident.update');
        Route::delete('/admin/vicepresident/{user}', [VicePresident::class, 'destroy'])->name('vicepresident.destroy');



    // Manage Users
    Route::get('/admin/manage-user', [AdminUserController::class, 'index'])->name('admin.manage-users');
    Route::get('/admin/impersonate/{user}', [AdminUserController::class, 'impersonate'])->name('admin.impersonate');
    Route::get('/admin/stop-impersonating', [AdminUserController::class, 'stopImpersonating'])->name('admin.stop-impersonating');

    // Add other admin-only routes here

});
