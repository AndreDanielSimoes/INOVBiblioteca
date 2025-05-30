@props(['publisher'])

<x-panel class="flex flex-col text-center">
    <div class="py-3">
        <h3 class="group-hover:text-blue-400 text-xl font-bold transition-colors duration-500">{{ $publisher->name }}</h3>
    </div>
    <div class="mx-auto">
        <x-publisher-logo :Publisher="$publisher"/>
    </div>

    @auth
        @if (Auth::User()->role === 1)
            <div class="mt-5">
                <a href="/publishers/{{ $publisher->id }}/edit" class="bg-red-500 hover:bg-red-400 font-bold px-4 py-1 mt-2 rounded">
                    Edit Details
                </a>
            </div>
        @endif
    @endauth

</x-panel>
