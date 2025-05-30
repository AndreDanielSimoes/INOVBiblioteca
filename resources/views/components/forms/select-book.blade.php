<div class="mb-4">
    <label for="book_id" class="inline-flex items-center gap-x-2 font-bold mb-2">
        <span class="w-2 h-2 bg-white inline-block"></span>
        Book
    </label>

    <select name="book_id" id="book_id"
            class="w-full border border-white/10 text-white rounded p-2 bg-gray-700">
        <option disabled selected>Select a book</option>
        @foreach ($availableBooks as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
        @endforeach
    </select>

    @error('book_id')
    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
    @enderror
</div>
