<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TRG\AtelierController;
use App\Http\Controllers\TRG\ProductionController;
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
//     return view('welcome');
// });


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')
    ->namespace('App\Http\Controllers')
    ->group(function () {

        Route::resources(['profile' => 'Profile\ProfileController']);
    });


Route::prefix('admin')
    ->middleware(['auth'])
    ->namespace('App\Http\Controllers')
    ->group(function () {
        Route::resources(['roles' => 'Admin\RoleController']);
        Route::resources(['users' => 'Admin\UserController']);
        Route::resources(['permissions' => 'Admin\PermissionController']);
    });

Route::prefix('trg')
    ->middleware('auth')
    ->namespace('App\Http\Controllers')
    ->group(function () {

        Route::get('/ateliers/{atelier}/affecter', [AtelierController::class, 'affecter'])->name('atelier.affecter');
        Route::put('/ateliers/{atelier}/affectation', [AtelierController::class, 'affectation'])->name('atelier.affectation');
        Route::resources(['article' => 'TRG\ArticleController']);
        Route::resources(['atelier' => 'TRG\AtelierController']);
        Route::resources(['production' => 'TRG\ProductionController']);
        Route::get('/production/{atelier}/{date}/{usine}', [ProductionController::class, 'show'])->name('production.show');
        Route::get('/productions/{atelier}/{date}/{usine}', [ProductionController::class, 'edit'])->name('productions.edit');
    });
