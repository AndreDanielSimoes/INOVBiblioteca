<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Meet Your Publishers</h1>

                <x-forms.form action="/search" class="mt-6">
                    <x-forms.input :label="false" name="q" placeholder="I'm looking for..." />
                </x-forms.form>
        </section>

        <section>
            <x-section-heading>Publishers</x-section-heading>
            <div class="flex flex-wrap gap-8 py-8 justify-center">
                @foreach ($publishers as $publisher)
                    <x-publisher-card
                        :publisher="$publisher"
                        class="w-full md:w-1/2 text-wrap"
                    />
                @endforeach
            </div>

            <div>
                {{ $publishers->links() }}
            </div>
        </section>

    </div>
</x-layout>
