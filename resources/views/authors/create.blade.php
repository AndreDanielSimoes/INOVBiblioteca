<x-layout>
    <h1 class="font-bold text-4xl text-center">Add A New Author</h1>

    <x-forms.form method="POST" action="/authors">
        <x-forms.input label="Name" name="name" placeholder="Author Name" />
        <x-forms.input label="Image" name="image" placeholder="Author Portrait URL" />

        <x-forms.button>Add Author</x-forms.button>
    </x-forms.form>
</x-layout>
