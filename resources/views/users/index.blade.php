<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if (session('success'))
                    <div class="text-green-400 font-semibold mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                    @php
                        $headings = ['Name', 'Email', 'Admin', 'Details'];
                        $rows = $users->map(fn($user) => [
                            $user->profile_photo_path
                                ? '<img src="' . asset('storage/' . $user->profile_photo_path) . '" alt="Profile Photo" class="inline-block w-8 h-8 rounded-full mr-2">' . $user->name
                                : $user->name,
                            $user->email,
                            view('users.partials.toggle-role', ['user' => $user]),
                            view('users.partials.view-button', ['user' => $user]),
                        ]);
                    @endphp


                <x-admin-table :headings="$headings" :rows="$rows"/>
            </div>
        </div>
    </div>
</x-app-layout>
