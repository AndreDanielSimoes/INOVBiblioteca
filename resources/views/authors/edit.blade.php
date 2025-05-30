<x-layout>
    <h1 class="font-bold text-4xl text-center">Editing Author Details For <span class="font-extrabold text-red-500">{{ $author->name }}</span></h1>

    <x-forms.form method="POST" action="/authors/{{ $author->id }}">
        @csrf
        @method('PATCH')

        <x-forms.input
            label="Name"
            name="name"
            value="{{ $author->name }}" />
        <x-forms.input
            label="Image"
            name="image"
            value=" {{ $author->image }}" />

        <x-forms.button>Update</x-forms.button>
        <button form="delete-form" class="bg-red-600 rounded py-2 px-6 font-bold ms-2">Delete</button>
        <a href="/" class="text-sm font-semibold ms-4 text-white">Cancel</a>
    </x-forms.form>

    <form method="POST" action="/authors/{{ $author->id }}"  id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
