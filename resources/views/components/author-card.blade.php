@props(['book', 'author'])

<x-panel class="flex flex-col flex-wrap text-center">
    <div class="py-8">

        <h3 class="group-hover:text-blue-400 text-xl font-bold transition-colors duration-500">{{ $author->name }}</h3>

        <img src="{{ $author->image }}" alt="" class="max-w-[225px] max-h-[225px] rounded-xl mx-auto">
            <ul class="text-sm mt-4 text-gray-300 list-disc list-inside">

            @foreach ($author->books->sortBy('title')->take(4) as $book)
                <li>{{ $book->title }}</li>
            @endforeach

            </ul>
        </div>
</x-panel>
