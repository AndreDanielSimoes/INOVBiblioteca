<x-app-layout>
    <div class="mt-10 pb-20 max-w-[986px] mx-auto text-white">
        <h1 class="font-bold text-4xl text-center">Book Requests</h1>

        <div class="flex justify-center gap-10 py-7">
            <div class="flex flex-col items-center">
                <x-section-heading>Active Requests</x-section-heading>
                <p class="text-2xl font-bold mt-1 text-red-400">
                    {{ $stats['active_requests'] }}
                </p>
            </div>

            <div class="flex flex-col items-center">
                <x-section-heading>Requests in Last 30 Days</x-section-heading>
                <p class="text-2xl font-bold mt-1 text-red-400">
                    {{ $stats['last_30_days'] }}
                </p>
            </div>

            <div class="flex flex-col items-center">
                <x-section-heading>Deliveries Today</x-section-heading>
                <p class="text-2xl font-bold mt-1 text-red-400">
                    {{ $stats['delivered_today'] }}
                </p>
            </div>
        </div>

        <section>
            @if ($errors->has('limit'))
                <div class="mb-4 p-4 bg-red-500/20 border border-red-500 text-red-300 rounded">
                    {{ $errors->first('limit') }}
                </div>
            @endif

            <form method="POST" action="/requisitions">
                @csrf

                <div class="mb-4">
                    <label for="book_id" class="inline-flex items-center gap-x-2 font-bold mb-2">
                        <span class="w-2 h-2 bg-white inline-block"></span>Select a Book
                    </label>
                    <select name="book_id" id="book_id"
                            class="w-full border border-white/10 text-white rounded p-2 bg-gray-700 text-center">
                        <option disabled selected>Select a book</option>
                        @foreach ($availableBooks as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-center">
                    <x-forms.button>Request Book</x-forms.button>
                </div>
            </form>
        </section>

        @if (auth()->user()->isAdmin())
            <section class="mt-10 space-y-4">
                <x-section-heading>All Requests</x-section-heading>

                @php
                    $headings = ['Book', 'Requested At', 'Delivery Date', 'Requested By', 'Days Requested', 'Status'];
                    $rows = $requisitions->map(fn($r) => [
                        $r->book->title,
                        $r->requested_at->format('F j, Y'),
                        $r->delivery_date->format('F j, Y'),
                        $r->user->profile_photo_path
        ? '<img src="' . asset('storage/' . $r->user->profile_photo_path) . '" alt="Profile Photo" class="inline-block w-8 h-8 rounded-full mr-2">' . $r->user->name
        : $r->user->name,
                        $r->requested_at->diffForHumans(),
                    view('requisitions.partials.toggle-status', ['requisition' => $r]),
]);
                @endphp

                <x-admin-table :headings="$headings" :rows="$rows"/>
            </section>
        @else
            <section class="mt-8">
                <x-section-heading>My Active Requests</x-section-heading>

                <div class="space-y-6 mt-4">
                    @forelse ($activeRequisitions as $requisition)
                        <div class="bg-gray-800 p-4 rounded-md flex items-center gap-6">
                            <img src="{{ $requisition->book->cover }}"
                                 alt="Cover for {{ $requisition->book->title }}"
                                 class="w-24 h-auto rounded shadow">
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-white">{{ $requisition->book->title }}</h3>
                                <p class="text-sm text-gray-400 mt-1">Requested at: {{ $requisition->requested_at->format('F j, Y') }}</p>
                                <p class="text-sm text-gray-400">Delivery Date: {{ $requisition->delivery_date->format('F j, Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400">You have no active requests.</p>
                    @endforelse
                </div>
            </section>

            <section class="mt-12">
                <x-section-heading>My Previous Requests</x-section-heading>

                <div class="space-y-6 mt-4">
                    @forelse ($pastRequisitions as $requisition)
                        <div class="bg-gray-700 p-4 rounded-md flex items-center gap-6">
                            <img src="{{ $requisition->book->cover }}"
                                 alt="Cover for {{ $requisition->book->title }}"
                                 class="w-24 h-auto rounded shadow opacity-70">
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-white">{{ $requisition->book->title }}</h3>
                                <p class="text-sm text-gray-400 mt-1">Requested at: {{ $requisition->requested_at->format('F j, Y') }}</p>
                                <p class="text-sm text-gray-400">Delivery Date: {{ $requisition->delivery_date->format('F j, Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No previous requests found.</p>
                    @endforelse
                </div>
            </section>
        @endif
    </div>
</x-app-layout>
