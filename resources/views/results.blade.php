<x-layout>
    <x-section-heading>Search Results</x-section-heading>

    @if($books->isNotEmpty())
        <h2 class="text-xl font-semibold mt-6">Books</h2>
        <div class="space-y-6">
            @foreach($books as $book)
                <x-book-card-wide :$book />
            @endforeach
        </div>
    @endif

    @if($authors->isNotEmpty())
        <h2 class="text-xl font-semibold mt-12">Authors</h2>
        <div class="grid gap-6 mt-4 md:grid-cols-2">
            @foreach($authors as $author)
                <x-author-card :author="$author" />
            @endforeach
        </div>
    @endif

    @if($publishers->isNotEmpty())
        <h2 class="text-xl font-semibold mt-12">Publishers</h2>
        <div class="grid gap-6 mt-4 md:grid-cols-2">
            @foreach($publishers as $publisher)
                <div class="p-4 border rounded-lg">
                    <h3 class="font-bold">{{ $publisher->name }}</h3>
                </div>
            @endforeach
        </div>
    @endif

    @if($books->isEmpty() && $authors->isEmpty())
        <p class="text-gray-400 mt-8">No results found for "{{ request('q') }}".</p>
    @endif
</x-layout>
