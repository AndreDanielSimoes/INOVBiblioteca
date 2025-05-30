<?php

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/authors/find-or-create', function (Request $request) {
    $author = Author::firstOrCreate(
        ['name' => $request->name],
        ['image' => $request->image]
    );
    return response()->json($author);
});

Route::post('/publishers/find-or-create', function (Request $request) {
    $publisher = Publisher::firstOrCreate(
        ['name' => $request->name],
        ['logo' => $request->image ?? 'https://media.istockphoto.com/id/851887036/vector/colorful-icon.jpg']
    );
    return response()->json($publisher);
});

