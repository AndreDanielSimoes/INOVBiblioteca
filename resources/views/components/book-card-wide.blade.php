@props(['book'])

<x-panel class="relative flex gap-x-6">
    <div>
        <x-book-cover :book="$book"/>
    </div>

    <div class="flex-1 flex flex-col">
        <p class="self-start text-sm text-gray-300">{{ $book->authors->take(3)->pluck('name')->join(', ') }}</p>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-400 transition-colors duration-1000">{{ $book->title }}</h3>
        <p class="text-sm text-gray-300 mt-auto italic">{{ $book->description }}</p>
        <p class="text-sm text-gray-300 mt-5">Publisher: {{ $book->publisher?->name ?? 'N/A' }}</p>
        <p class="text-sm text-gray-300 mt-auto">ISBN: {{ $book->isbn }}</p>
        <p class="text-sm text-gray-300 mt-auto">Price: {{ $book->price }}€</p>

        <p class="mt-3 text-sm font-bold {{ $book->isRequested() ? 'text-red-400' : 'text-green-400' }}">
            {{ $book->isRequested() ? 'Not Available for Request' : 'Available to Request' }}
        </p>
    </div>

    <div>
        @foreach($book->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>

    @auth
        <div class="absolute bottom-4 right-4 flex items-center gap-2">
            <a href="/books/{{ $book->id }}"
               class="bg-blue-600 hover:bg-blue-500 font-bold px-4 py-1 rounded text-white">
                View Details
            </a>
        </div>
    @endauth
</x-panel>
