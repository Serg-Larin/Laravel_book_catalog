<?php

use App\Http\Controllers\MainController;
use \App\Http\Controllers\Admin\BookController;
use \App\Http\Controllers\Admin\AuthorController;
use \App\Http\Controllers\Admin\OrderController;
use \App\Http\Controllers\Admin\CommentController;
use \App\Http\Controllers\QweController;
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

Route::get('/main', [MainController::class,'main'])->name('main');
Route::get('/', [MainController::class,'index'])->name('main.catalog');
Route::get('/book/{id}', [MainController::class,'oneBook'])->name('one.book');
Route::post('order/new', [OrderController::class, 'newOrder'])->name('order.new');
Route::post('comment/new', [CommentController::class, 'createNew'])->name('comment.new');


Route::group(['middleware' => 'auth.basic', 'prefix' => 'admin'], function () {

        Route::resource('book', BookController::class);
        Route::resource('author', AuthorController::class);

        Route::prefix('order')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('order.index');
            Route::get('{id}', [OrderController::class, 'oneOrder'])->name('order.one');
            Route::patch('{id}', [OrderController::class, 'orderStatusUpdate'])->name('order.update');
        });

        Route::prefix('comment')->group(function () {
            Route::get('', [CommentController::class, 'index'])->name('comment.index');
            Route::delete('{id}', [CommentController::class, 'delete'])->name('comment.delete');
            Route::patch('{id}', [CommentController::class, 'approve'])->name('comment.approve');

        });
});


