<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Mail\RequestConfirmation;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index']);
Route::get('/books/create', [BookController::class, 'create'])->middleware('auth');
Route::post('/books', [BookController::class, 'store'])->middleware('auth');
route::get('/books/{book}/edit', [BookController::class, 'edit'])->middleware('auth');
Route::patch('/books/{book}', [BookController::class, 'update'])->middleware('auth');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware('auth');
Route::get('/books/{book}', [BookController::class, 'show']);
Route::post('/books/{book}/notify', [BookController::class, 'notifyWhenAvailable'])->middleware('auth');



Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/create', [AuthorController::class, 'create'])->middleware('auth');
Route::post('/authors', [AuthorController::class, 'store'])->middleware('auth');
Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->middleware('auth');
Route::patch('/authors/{author}', [AuthorController::class, 'update'])->middleware('auth');
Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->middleware('auth');

Route::get('/publishers', [PublisherController::class, 'index']);
Route::get('/publishers/create', [PublisherController::class, 'create'])->middleware('auth');
Route::post('/publishers', [PublisherController::class, 'store'])->middleware('auth');
Route::get('/publishers/{publisher}/edit', [PublisherController::class, 'edit'])->middleware('auth');
Route::patch('/publishers/{publisher}', [PublisherController::class, 'update'])->middleware('auth');
Route::delete('/publishers/{publisher}', [PublisherController::class, 'destroy'])->middleware('auth');

Route::get('/requisitions', [RequisitionController::class, 'index'])->middleware('auth');
Route::post('/requisitions', [RequisitionController::class, 'store'])->middleware('auth');
Route::get('/requisitions/dispatch-return-reminders', [RequisitionController::class, 'dispatchReturnReminderEmails'])->middleware('auth');
Route::patch('/requisitions/{requisition}/toggle-active', [RequisitionController::class, 'toggleActive'])->middleware('auth')->name('requisitions.toggle');


Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->middleware('auth');


Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->middleware('auth');
Route::patch('/admin/reviews/{review}/status', [ReviewController::class, 'updateStatus'])->middleware('auth');


Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth');



Route::get('/search', SearchController::class);

Route::get('/tags/{tag:name}', TagController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
