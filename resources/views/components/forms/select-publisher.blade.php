<div class="mb-4">
    <label for="publisher_id" class="inline-flex items-center gap-x-2 font-bold mb-2"><span
            class="w-2 h-2 bg-white inline-block"></span>Publisher</label>
    <select name="publisher_id" id="publisher_id"
            class="w-full border border-white/10 text-white rounded p-2 bg-gray-700">
        <option disabled selected>Select a publisher</option>
        @foreach ($publishers as $publisher)
            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
        @endforeach
    </select>
</div>
