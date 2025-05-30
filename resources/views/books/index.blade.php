<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Looking For Something To Read?</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="I feel like reading..."/>
            </x-forms.form>
        </section>

        <section class="text-center text-lg">
            @auth
                @if (Auth::User()->role === 1)
                    <a href="/books/create" class="bg-red-500 hover:bg-red-400 font-bold px-4 py-1 rounded">Add a
                        Book</a>
                @endif
            @endauth
        </section>

        <section>
            <x-section-heading>Genre</x-section-heading>

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
                    <x-book-card-wide :$book/>
                @endforeach

                <div>
                    {{ $books->links() }}
                </div>
            </div>
        </section>

    </div>
</x-layout>
