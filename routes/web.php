<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{any?}', [AppController::class, 'index'])->where('any', '.*');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('grant-password', function () {
    $response = Http::post(env('API_URL').'oauth/token', [
        'grant_type' => 'password',
        'client_id' => env('CLIENT_ID_GRANT_PASSWORD'),
        'client_secret' => env('CLIENT_SECRET_GRANT_PASSWORD'),
        'username' => 'eliezer.c.alves2015@gmail.com',
        'password' => 'teste123',
        'scope' => '',
    ]);

    dd($response->json());
});

