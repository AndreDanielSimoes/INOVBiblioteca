@props(['publisher'])

<x-panel class="flex flex-col text-center">
    <div class="py-3">
        <h3 class="group-hover:text-blue-400 text-xl font-bold transition-colors duration-500">{{ $publisher->name }}</h3>
    </div>
    <div class="mx-auto">
        <x-publisher-logo :publisher="$publisher"/>
    </div>
</x-panel>
