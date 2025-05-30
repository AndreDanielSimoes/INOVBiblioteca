@props(['book'])

<x-panel class="flex flex-col text-center h-full"> <!-- add h-full here -->
    <div class="flex flex-col h-full"> <!-- NEW WRAPPER -->
        <div class="self-start text-sm">{{ $book->publisher->name }}</div>

        <div class="py-8">
            <h3 class="group-hover:text-blue-400 text-xl font-bold transition-colors duration-500">{{ $book->title }}</h3>
            <p class="text-sm mt-4">
                <span class="self-start text-sm text-gray-300">
                    {{ $book->authors->take(3)->pluck('name')->join(', ') }}
                </span>
            </p>
        </div>

        <div class="flex justify-center flex-wrap gap-2 mt-4">
            @foreach($book->tags as $tag)
                <x-tag :$tag size="small"/>
            @endforeach
        </div>
    </div>
</x-panel>

