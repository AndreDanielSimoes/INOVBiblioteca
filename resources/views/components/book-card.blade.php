@props(['book'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $book->publisher->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-400 text-xl font-bold transition-colors duration-500">{{ $book->title }}</h3>
        <p class="text-sm mt-4">
            <span class="self-start text-sm text-gray-300">
                {{ $book->authors->take(3)->pluck('name')->join(', ') }}
            </span>
        </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach($book->tags as $tag)
                <x-tag :$tag size="small"/>
            @endforeach
        </div>

        <x-publisher-logo :publisher="$book->publisher"/>
    </div>
</x-panel>
