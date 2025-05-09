@props(['book'])

<x-panel class="flex gap-x-6">
    <div>
        <x-book-cover :book="$book"/>
    </div>

    <div class="flex-1 flex flex-col">
        <p class="self-start text-sm text-gray-300">{{ $book->authors->take(3)->pluck('name')->join(', ') }}</p>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-400 transition-colors duration-1000">{{ $book->title }}</h3>
        <p class="text-sm text-gray-300 mt-auto italic">{{ $book->description }}</p>
        <p class="text-sm text-gray-300 mt-5">Publisher: {{ $book->publisher->name }}</p>
        <p class="text-sm text-gray-300 mt-auto">ISBN: {{ $book->isbn }}</p>
        <p class="text-sm text-gray-300 mt-auto">Price: {{ $book->price }}€</p>
    </div>


    <div>
        @foreach($book->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>
</x-panel>

