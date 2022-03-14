
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('jugador', JugadorController::class)->middleware('auth');
Auth::routes(['register'=>true,'reset'=>false]);

Route::get('/home', [JugadorController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/', [JugadorController::class, 'index'])->name('home');
});
