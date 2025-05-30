<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\BookNotification;
use App\Models\Tag;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('books.index', [
            'books' => Book::latest()->paginate(6),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'publisher_id' => 'required|exists:publishers,id',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'price' => 'required|numeric|min:0',
            'cover' => 'required|url|max:2048',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'publisher_id' => $validated['publisher_id'],
            'isbn' => $validated['isbn'],
            'price' => $validated['price'],
            'cover' => $validated['cover'],
        ]);

        $book->authors()->sync($validated['authors']);
        $book->tags()->sync($validated['tags'] ?? []);

        return redirect('/');
    }


    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $requisitions = $book->requisitions()
            ->with('user')
            ->latest('requested_at')
            ->get();

        $canReview = false;

        if (auth()->check()) {
            $canReview = $book->requisitions()
                ->where('user_id', auth()->id())
                ->where('active', false)
                ->exists();
        }

        $reviews = $book->reviews()
            ->where('status', 'accepted')
            ->with('user')
            ->latest()
            ->get();

        $recommendedBooks = Book::search($book->description)
            ->get()
            ->filter(fn($b) => $b->id !== $book->id)
            ->take(5);

        return view('books.show', compact('book', 'requisitions', 'canReview', 'reviews', 'recommendedBooks'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        $validated = $request->validated();


        $book->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'publisher_id' => $validated['publisher_id'],
            'isbn' => $validated['isbn'],
            'price' => $validated['price'],
            'cover' => $validated['cover'],
        ]);


        $book->authors()->sync($validated['authors']);
        $book->tags()->sync($validated['tags'] ?? []);


        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();
        $book->tags()->detach();
        $book->delete();

        return redirect('/');
    }

    public function notifyWhenAvailable(Request $request, Book $book)
    {
        $user = $request->user();

        if ($book->isRequested()) {
            BookNotification::firstOrCreate([
                'user_id' => $user->id,
                'book_id' => $book->id,
            ]);

            return back()->with('success', 'You will be notified when this book is available.');
        }

        return back()->withErrors(['notify' => 'This book is already available.']);
    }


}
