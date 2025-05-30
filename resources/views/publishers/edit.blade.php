<x-layout>
    <h1 class="font-bold text-4xl text-center">Editing Publisher Details For <span class="font-extrabold text-red-500">{{ $publisher->name }}</span></h1>

    <x-forms.form method="POST" action="/publishers/{{ $publisher->id }}">
        @csrf
        @method('PATCH')

        <x-forms.input
            label="Name"
            name="name"
            value="{{ $publisher->name }}" />
        <x-forms.input
            label="Logo"
            name="logo"
            value="{{ $publisher->logo }}" />

        <x-forms.button>Update</x-forms.button>
        <button form="delete-form" class="bg-red-600 rounded py-2 px-6 font-bold ms-2">Delete</button>
        <a href="/" class="text-sm font-semibold ms-4 text-white">Cancel</a>
    </x-forms.form>

    <form method="POST" action="/publishers/{{ $publisher->id }}"  id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
