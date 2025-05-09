<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Looking For Your Favorite Author?</h1>

                <x-forms.form action="/search" class="mt-6">
                    <x-forms.input :label="false" name="q" placeholder="I want to check on..." />
                </x-forms.form>
        </section>

        <section>
            <x-section-heading>Authors</x-section-heading>
            <div class="flex flex-wrap gap-8 py-8 justify-center">
                @foreach ($authors as $author)
                    <x-author-card
                        :author="$author"
                        :book="$author->books->first()"
                        class="w-full md:w-1/2"
                    />
                @endforeach
            </div>

            <div>
                {{ $authors->links() }}
            </div>
        </section>

    </div>
</x-layout>
