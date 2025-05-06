<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Looking For Something To Read?</h1>

                <x-forms.form action="/search" class="mt-6">
                    <x-forms.input :label="false" name="q" placeholder="I feel like reading..." />
                </x-forms.form>
        </section>

        <section class="pt-10">
            <x-section-heading>Popular Books</x-section-heading>

            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach($books->take(3) as $book)
                    <x-book-card :$book />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>

            <div class="mt-6 space-x-1">
                @foreach($tags as $tag)
                    <x-tag :$tag/>
                @endforeach
            </div>

        </section>

        <section>
            <x-section-heading>Newly Added</x-section-heading>
            <div class="mt-6 space-y-6">
                @foreach($books as $book)
                    <x-book-card-wide :$book />
                @endforeach
            </div>
        </section>

    </div>
</x-layout>
