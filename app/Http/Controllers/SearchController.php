<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $query = request('q');

       $books = Book::query()
           ->with(['tags', 'authors', 'publisher'])
           ->where('title', 'LIKE', '%' . request('q') . '%')
           ->orWhereHas('authors', function ($q) use ($query) {
               $q->where('name', 'LIKE', "%{$query}%");
           })
           ->orWhereHas('publisher', function ($q) use ($query) {
               $q->where('name', 'LIKE', "%{$query}%");
           })
           ->get();

        $authors = Author::where('name', 'LIKE', "%{$query}%")->get();

        $publishers = Publisher::where('name', 'LIKE', "%{$query}%")->get();

        return view('results', [
            'books' => $books,
            'authors' => $authors,
            'publishers' => $publishers,
        ]);
    }
}
