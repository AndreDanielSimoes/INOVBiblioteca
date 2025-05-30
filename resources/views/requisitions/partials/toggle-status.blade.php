<form method="POST" action="{{ route('requisitions.toggle', $requisition->id) }}">
    @csrf
    @method('PATCH')

    <button type="submit"
            class="px-2 py-1 text-xs font-semibold rounded
               {{ $requisition->active ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-400 hover:bg-gray-500' }}
               text-white transition">
        {{ $requisition->active ? 'Active' : 'Inactive' }}
    </button>
</form>
