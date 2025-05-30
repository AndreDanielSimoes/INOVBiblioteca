<x-layout>
    @foreach ($errors->all() as $error)
        <div class="mb-4 p-4 bg-red-500/20 border border-red-500 text-red-300 rounded">
            {{ $error }}
        </div>
    @endforeach

    <div class="max-w-5xl mx-auto px-4 py-10 text-white">
        <div class="flex flex-col md:flex-row md:items-start gap-10">

            <div class="w-full md:max-w-[200px] flex-shrink-0">
                <x-book-cover :book="$book"/>
            </div>


            <div class="flex-1">
                <h1 class="text-3xl font-bold mb-4">{{ $book->title }}</h1>

                <p class="text-gray-300 mb-2">
                    <strong>Author(s):</strong> {{ $book->authors->pluck('name')->join(', ') }}</p>
                <p class="text-gray-300 mb-2"><strong>Publisher</strong>: {{ $book->publisher?->name ?? 'N/A' }}</p>
                <p class="text-gray-300 mb-2"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p class="text-gray-300 mb-2"><strong>Price:</strong> {{ $book->price }}€</p>

                <div class="text-gray-300 mb-4">
                    <strong>Description:</strong>
                    <p class="mt-1">{{ $book->description }}</p>
                </div>


                <div class="mb-4 flex flex-wrap gap-2">
                    @foreach($book->tags as $tag)
                        <x-tag :$tag/>
                    @endforeach
                </div>


                <p class="font-bold mb-6 {{ $book->isRequested() ? 'text-red-400' : 'text-green-400' }}">
                    {{ $book->isRequested() ? 'Not Available for Request' : 'Available to Request' }}
                </p>


                @auth
                    <div class="flex gap-4 flex-wrap">
                        @if (Auth::user()->role === 1)
                            <a href="/books/{{ $book->id }}/edit"
                               class="bg-red-500 hover:bg-red-400 font-bold px-4 py-2 rounded">
                                Edit Book
                            </a>
                        @endif

                        @if (! $book->isRequested())
                            <form method="POST" action="/requisitions">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit"
                                        class="bg-green-600 hover:bg-green-500 px-4 py-2 font-bold rounded">
                                    Request Book
                                </button>
                            </form>
                        @else
                            <form method="POST" action="/books/{{ $book->id }}/notify">
                                @csrf
                                <button type="submit"
                                        class="bg-yellow-600 hover:bg-yellow-500 px-4 py-2 font-bold rounded">
                                    Notify me when available
                                </button>
                            </form>
                        @endif
                    </div>
                @endauth

            </div>
        </div>

        @if ($recommendedBooks->count())
            <section class="mt-16 relative z-10">
                <x-section-heading>You might also like</x-section-heading>
                <div class="grid lg:grid-cols-3 gap-8 mt-6">
                    @foreach ($recommendedBooks->take(3) as $recommended)
                        <div class="flex flex-col h-full">
                            <a href="/books/{{ $recommended->id }}" class="flex flex-col flex-grow">
                                <x-book-card :book="$recommended" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

        @endif

        <section class="mt-10">
            @auth
                @php
                    $hasCompletedRequisition = auth()->user()
                        ->requisitions
                        ->where('book_id', $book->id)
                        ->where('active', false)
                        ->isNotEmpty();
                @endphp

                @if ($hasCompletedRequisition)
                    <x-section-heading>Leave a Review!</x-section-heading>
                    <form method="POST" action="/books/{{ $book->id }}/reviews" class="mt-2">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">

                        <textarea name="content" rows="4" class="w-full p-2 rounded text-black"
                                  placeholder="Write your thoughts...">{{ old('content') }}</textarea>

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-500 px-4 py-2 text-white font-bold rounded mt-2">
                            Submit Review
                        </button>
                    </form>
                @endif
            @endauth
        </section>

        @if ($reviews->count())
            <section class="mt-12">
                <x-section-heading>Approved Reviews</x-section-heading>

                <div class="space-y-4 mt-4">
                    @foreach ($reviews as $review)
                        <div class="bg-gray-700 p-4 rounded-md">
                            <p class="text-white"><strong>{{ $review->user->name }}</strong> says:</p>
                            <p class="text-gray-300 mt-1">{{ $review->body }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="mt-16 text-white">
            <h2 class="text-xl font-semibold mb-4">Requisition History</h2>

            @forelse ($requisitions as $requisition)
                <div class="bg-gray-800 p-4 rounded-md mb-4">
                    <p><strong>Requested by:</strong> {{ $requisition->user->name }}</p>
                    <p class="text-gray-400">Requested at: {{ $requisition->requested_at->format('F j, Y') }}</p>
                </div>
            @empty
                <p class="text-gray-400">No requisitions found for this book.</p>
            @endforelse
        </section>

    </div>
</x-layout>


