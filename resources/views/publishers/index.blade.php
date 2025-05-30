<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Meet Your Publishers</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="I'm looking for..." />
            </x-forms.form>
        </section>

        <section class="text-center text-lg">
            @auth
                @if (Auth::User()->role === 1)
                    <a href="/publishers/create" class="bg-red-500 hover:bg-red-400 font-bold px-4 py-1 rounded">Add Publisher</a>
                @endif
            @endauth
        </section>

        <section>
            <x-section-heading>Publishers</x-section-heading>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 py-8">
                @foreach ($publishers as $publisher)
                    <x-publisher-card
                        :publisher="$publisher"
                    />
                @endforeach
            </div>

            <div>
                {{ $publishers->links() }}
            </div>
        </section>
    </div>
</x-layout>

