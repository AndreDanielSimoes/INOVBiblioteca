<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Looking For Your Favorite Author?</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="I want to check on..." />
            </x-forms.form>
        </section>

        <section class="text-center text-lg">
            @auth
                @if (Auth::User()->role === 1)
                    <a href="/authors/create" class="bg-red-500 hover:bg-red-400 font-bold px-4 py-1 rounded">Add Author</a>
                @endif
            @endauth
        </section>

        <section>
            <x-section-heading>Authors</x-section-heading>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-8">
                @foreach ($authors as $author)
                    <x-author-card
                        :author="$author"
                        :book="$author->books->first()"
                    />
                @endforeach
            </div>

            <div>
                {{ $authors->links() }}
            </div>
        </section>
    </div>
</x-layout>

