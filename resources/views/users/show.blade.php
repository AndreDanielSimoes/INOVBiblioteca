<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4">
        <div class="mt-6 text-white">
            <h2 class="text-xl font-semibold mb-3">{{ $user->name }}'s Information</h2>
            <p><strong>Username:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role == 1 ? 'Admin' : 'User' }}</p>
        </div>

        <section class="mt-6">
            <h2 class="text-xl font-semibold text-white">Requisition History</h2>

            @forelse ($requisitions as $requisition)
                <div class="bg-gray-800 p-4 rounded-md mt-4">
                    <h3 class="font-bold text-white">{{ $requisition->book->title }}</h3>
                    <p class="text-gray-400">Requested at: {{ $requisition->requested_at->format('F j, Y') }}</p>
                    <p class="text-gray-400">Delivery Date: {{ $requisition->delivery_date->format('F j, Y') }}</p>
                </div>
            @empty
                <p class="text-gray-400 mt-4">No requisitions found for this user.</p>
            @endforelse
        </section>
    </div>
</x-app-layout>
