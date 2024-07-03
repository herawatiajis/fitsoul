<?php

use App\Http\Controllers\CheckStatusMemberController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\SupplementController;
use App\Http\Controllers\CheckStatusController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MemberPackageController;
use App\Http\Controllers\RegistrationMemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');  
Route::get('/member-profile', [MemberProfileController::class, 'show'])->name('member-profile');
Route::get('/member-profile/edit', [MemberProfileController::class, 'edit'])->name('member-profile.edit');
Route::post('/member-profile/edit', [MemberProfileController::class, 'update'])->name('member-profile.update');

Route::get('authorized/google/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');

Route::get('authorized/google/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    
});

Route::controller(AuthController::class)->group(function() {
    Route::get('auth', 'index')->name('login');
    Route::post('login', 'login');
    Route::post('register', 'register')->name('register');
    Route::get('logout', 'logout')->name('logout')->middleware('auth');
    Route::post('/forgot-password-act', 'forgot_password_act')->name('forgot-password-act');
    Route::get('/forgot-password', 'forgot_password')->name('forgot-password');
    Route::get('/validasi-forgot-password/{token}', 'validasi_forgot_password')->name('validasi-forgot-password');
    Route::post('/validasi-forgot-password-act', 'validasi_forgot_password_act')->name('validasi-forgot-password-act');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');



// Normal Users Route List
Route::middleware(['auth', 'user-access:member'])->group(function () {
    Route::resource('/registration-member', RegistrationMemberController::class);
    Route::resource('/check-status-member', CheckStatusMemberController::class);
    Route::post('/checkout', [RegistrationMemberController::class, 'checkout']);
    
});

// Normal Admin Route List
Route::middleware(['auth', 'user-access:super admin'])->group(function () {
    Route::get('admin/home', [AdminController::class, 'adminHome'])->name('admin/home');
    Route::resource('/user', UserController::class);
    Route::resource('/check-status', CheckStatusController::class);
    Route::delete('/check-status-delete/{id}', [CheckStatusController::class, 'destroyCs']);
    Route::delete('/check-status-trainer-delete/{id}', [CheckStatusController::class, 'destroyCst']);

    Route::resource('member-package', MemberPackageController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('/registration-admin', RegistrationController::class);
    Route::resource('trainer', TrainerController::class);
    Route::resource('supplement', SupplementController::class);
    Route::resource('carousel', CarouselController::class);
    Route::resource('configuration', ConfigurationController::class);
    Route::resource('contact-us', ContactController::class);
    Route::resource('registration', RegistrationController::class);

    Route::post('/check-in', [RegistrationController::class, "checkIn"]);
    Route::post('/check-in-trainer', [RegistrationController::class, "trainerCheckIn"]);
    
});

Route::middleware(['auth', 'admin-access:admin'])->group(function () {
    // Route::resource('check-status', CheckStatusController::class);
    // Route::resource('registration', RegistrationController::class);
    // Route::resource('contact', ContactController::class);
});
