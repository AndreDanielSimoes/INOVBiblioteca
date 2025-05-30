<form method="POST" action="/users/{{ $user->id }}/toggle-role">

@csrf
    @method('PATCH')

    <button type="submit"
            class="px-3 py-1 rounded text-sm font-semibold
                   {{ $user->role === 1 ? 'bg-green-500 hover:bg-green-400' : 'bg-gray-500 hover:bg-gray-400' }}">
        {{ $user->role === 1 ? 'Admin' : 'User' }}
    </button>
</form>
