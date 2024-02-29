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
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TwichController;
use App\Http\Controllers\UserController;
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
   
    Route::get('chatters', [TwichController::class, 'getChatters'])->name('get-chatters');
    // Route::get('send/', [LoginController::class, 'getToken'])->name('getToken');

    Route::get('summary', [SummaryController::class, 'index'])->name('summary');
    // Route::get('', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('support', [SupportController::class, 'index'])->name('support');
    Route::get('my_agendas', [MyAgendaController::class, 'index'])->name('my_agendas');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/edit', [ProfileController::class, 'editUser'])->name('edit-user');
    Route::get('history', [HistoryController::class, 'index'])->name('history');
    Route::get('donations', [DonationController::class, 'index'])->name('donation');
    Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::post('schedule/update', [ScheduleController::class, 'updateScheduler'])->name('schedule-update');
    Route::get('test', [ScheduleController::class, 'test'])->name('test');
    Route::get('privacy', [PrivacyController::class, 'index'])->name('privacy');

    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('login_token', [LoginController::class, 'getToken'])->name('getToken');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('admin', [AdminController::class, 'index'])->name('admin-login');
    Route::post('admin-login', [AdminController::class, 'login'])->name('admin-login');

    Route::get('login_test', [LoginController::class, 'login_test'])->name('login-test');
    Route::post('login-test-login', [LoginController::class, 'login_post'])->name('login-post');

    Route::get('admin/list', [AdminController::class, 'list'])->name('admin-list');
    Route::get('admin/schedulers', [AdminController::class, 'schedulers'])->name('admin-schedulers');
    Route::get('admin/rankings-points', [AdminController::class, 'rankingsPoints'])->name('admin-rankings-points');
    Route::get('admin/rankings-schedulers', [AdminController::class, 'rankingsSchedulers'])->name('admin-rankings-schedulers');
    
    Route::get('admin/users/upload/{id}', [AdminController::class, 'uploadUser'])->name('admin-user-add'); 
    Route::get('admin/deleted-users', [AdminController::class, 'usersDeleted'])->name('admin-users-deleted');
    Route::get('admin/schedulers/delete', [AdminController::class, 'deleteScheduler'])->name('admin-schedulers-delete');
    Route::get('admin/{id}', [AdminController::class, 'edit'])->name('admin-edit');
    Route::get('admin/show/{id}', [AdminController::class, 'show'])->name('admin-show');
    Route::get('admin/show/{id}/edit', [AdminController::class, 'editScheduler'])->name('admin-show-scheduler');
    Route::get('admin/delete/{id}', [AdminController::class, 'delete'])->name('admin-delete');
    Route::post('admin/post', [AdminController::class, 'post'])->name('admin-post'); 
    Route::post('admin/post/scheduler/delete', [AdminController::class, 'schedulersDelete'])->name('admin-post-scheduler-delete');
    Route::get('admin/logout', [AdminController::class, 'logoutAdmin'])->name('logout-admin');

    Route::get('referrer/{user_name}', [ScoreController::class, 'getPointSupport'])->name('referrer');

    // Route::post('admin-edit', [AdminController::class, 'login'])->name('admin-post');
    // Route::get('login', [LoginController::class, 'login'])->name('login');
    // Route::get('create', [SectionController::class, 'create'])->name('create');
    // Route::get('detail/{sectionId}', [SectionController::class, 'detail'])->name('detail');
    // Route::get('edit/{sectionId}', [SectionController::class, 'edit'])->name('edit');
});
