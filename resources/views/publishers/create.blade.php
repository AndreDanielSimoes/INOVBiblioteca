<x-layout>
    <h1 class="font-bold text-4xl text-center">Add A New Publisher</h1>

    <x-forms.form method="POST" action="/publishers">
        <x-forms.input label="Name" name="name" placeholder="Publisher Name" />
        <x-forms.input label="Logo" name="logo" placeholder="Publisher Logo URL" />

        <x-forms.button>Add Publisher</x-forms.button>
    </x-forms.form>
</x-layout>
