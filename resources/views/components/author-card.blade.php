@props(['book', 'author'])

<x-panel class="flex flex-col flex-wrap text-center">
    <div class="py-8">

        <h3 class="group-hover:text-blue-400 text-xl font-bold transition-colors duration-500">{{ $author->name }}</h3>

        <img src="{{ $author->image }}" alt="" class="max-w-[225px] max-h-[225px] rounded-xl mx-auto mt-4">
            <ul class="text-sm mt-4 text-gray-300 list-disc list-inside">

            @foreach ($author->books->sortBy('title')->take(4) as $book)
                <li>{{ $book->title }}</li>
            @endforeach

            </ul>
        </div>

    @auth
        @if (Auth::User()->role === 1)
            <div class="">
                <a href="/authors/{{ $author->id }}/edit" class="bg-red-500 hover:bg-red-400 font-bold px-4 py-1 rounded">
                    Edit Details
                </a>
            </div>
        @endif
    @endauth

</x-panel>
