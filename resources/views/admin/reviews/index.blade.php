<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 text-white">
        <h1 class="text-3xl font-bold mb-6">Review Moderation</h1>

        @foreach ($reviews as $review)
            <div class="bg-gray-800 p-4 rounded mb-4">
                <p><strong>User:</strong> {{ $review->user->name }}</p>
                <p><strong>Book:</strong> {{ $review->book->title }}</p>
                <p class="mt-2 text-gray-300">{{ $review->body }}</p>
                <p class="mt-2 text-sm text-yellow-400">Status: {{ ucfirst($review->status) }}</p>

                @if ($review->status === 'denied')
                    <p class="text-sm text-red-300 mt-1"><strong>Reason:</strong> {{ $review->rejection_reason }}</p>
                @endif

                <form method="POST" action="/admin/reviews/{{ $review->id }}/status" class="mt-4 space-y-2">
                    @csrf
                    @method('PATCH')

                    <label class="block text-sm">Change Status:</label>
                    <select name="status" class="text-black rounded w-full">
                        <option value="suspended" {{ $review->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="accepted" {{ $review->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="denied" {{ $review->status === 'denied' ? 'selected' : '' }}>Denied</option>
                    </select>

                    <textarea name="rejection_reason" rows="2" placeholder="Rejection reason (optional)" class="w-full rounded p-2 text-black">{{ $review->rejection_reason }}</textarea>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded font-bold">
                        Update Status
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
