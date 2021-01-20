<?php

use App\Http\Controllers\NewsController;
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

Route::get('/', function () {
    return redirect()->to('news');
});

Route::middleware(['auth'])->group(function () {
    Route::get('news/latest', [NewsController::class, 'latestNews'])
        ->name('news.latest');

    Route::patch('news/sub', [NewsController::class, 'subscription'])
        ->name('news.sub');;
});

Route::resource('news', NewsController::class)
    ->only('index', 'show')
    ->name('index', 'news.index');

require __DIR__.'/auth.php';
