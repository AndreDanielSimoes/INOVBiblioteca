<x-layout>
    <h1 class="font-bold text-4xl text-center">Editing Book Details For <span class="font-extrabold text-red-500">{{ $book->title }}</span></h1>

    <x-forms.form method="POST" action="/books/{{ $book->id }}">
        @csrf
        @method('PATCH')

        <x-forms.input
            label="Title"
            name="title"
            value="{{ $book->title }}" />
        <x-forms.input
            label="Description"
            name="description"
            value="{{ $book->description }}" />
        <x-forms.input
            label="Cover"
            name="cover"
            value=" {{ $book->cover }}" />
        <x-forms.select-authors />
        <x-forms.select-publisher />
        <x-forms.input
            label="ISBN"
            name="isbn"
            value="{{ $book->isbn }}"/>
        <x-forms.input
            label="Price"
            name="price"
            value="{{ $book->price }}"/>
        <x-forms.select-tags />

        <x-forms.button>Update</x-forms.button>
        <button form="delete-form" class="bg-red-600 rounded py-2 px-6 font-bold ms-2">Delete</button>
        <a href="/" class="text-sm font-semibold ms-4 text-white">Cancel</a>
    </x-forms.form>

    <form method="POST" action="/books/{{ $book->id }}"  id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
