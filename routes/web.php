<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAgendaController;
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

Route::get('/', function () {
    return view('home');
});
// Route::group(['middleware' => ['auth', 'permissionCheck:account-admin-manage'], 'prefix' => 'section', 'as' => 'sections.'], function () {
//     Route::get('index', [SectionController::class, 'index'])->name('index');
//     Route::get('create', [SectionController::class, 'create'])->name('create');
//     Route::get('detail/{sectionId}', [SectionController::class, 'detail'])->name('detail');
//     Route::get('edit/{sectionId}', [SectionController::class, 'edit'])->name('edit');
// });

Route::group([ '/'], function () {
    Route::get('summary', [SummaryController::class, 'index'])->name('summary');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('support', [SupportController::class, 'index'])->name('support');
    Route::get('my_agendas', [MyAgendaController::class, 'index'])->name('my_agendas');
    // Route::get('create', [SectionController::class, 'create'])->name('create');
    // Route::get('detail/{sectionId}', [SectionController::class, 'detail'])->name('detail');
    // Route::get('edit/{sectionId}', [SectionController::class, 'edit'])->name('edit');
});