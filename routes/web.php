<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MyAgendaController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('home');
// });
// Route::group(['middleware' => ['auth', 'permissionCheck:account-admin-manage'], 'prefix' => 'section', 'as' => 'sections.'], function () {
//     Route::get('index', [SectionController::class, 'index'])->name('index');
//     Route::get('create', [SectionController::class, 'create'])->name('create');
//     Route::get('detail/{sectionId}', [SectionController::class, 'detail'])->name('detail');
//     Route::get('edit/{sectionId}', [SectionController::class, 'edit'])->name('edit');
// });
// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['/'], function () {
    Route::get('/welcome', function () {
        return view('welcome');
    });
    Route::get('login_token', [LoginController::class, 'getToken'])->name('getToken');
    // Route::get('send/', [LoginController::class, 'getToken'])->name('getToken');

    Route::get('summary', [SummaryController::class, 'index'])->name('summary');
    // Route::get('', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('support', [SupportController::class, 'index'])->name('support');
    Route::get('my_agendas', [MyAgendaController::class, 'index'])->name('my_agendas');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('history', [HistoryController::class, 'index'])->name('history');
    Route::get('donations', [DonationController::class, 'index'])->name('donation');
    Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('privacy', [PrivacyController::class, 'index'])->name('privacy');
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('admin', [AdminController::class, 'index'])->name('admin-login');
    Route::post('admin-login', [AdminController::class, 'login'])->name('admin-login');
    Route::get('admin/list', [AdminController::class, 'list'])->name('admin-list');
    Route::get('admin/{id}', [AdminController::class, 'edit'])->name('admin-edit');
    Route::post('admin/post', [AdminController::class, 'post'])->name('admin-post');
    // Route::post('admin-edit', [AdminController::class, 'login'])->name('admin-post');
    // Route::get('login', [LoginController::class, 'login'])->name('login');
    // Route::get('create', [SectionController::class, 'create'])->name('create');
    // Route::get('detail/{sectionId}', [SectionController::class, 'detail'])->name('detail');
    // Route::get('edit/{sectionId}', [SectionController::class, 'edit'])->name('edit');
});
