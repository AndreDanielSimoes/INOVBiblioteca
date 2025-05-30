<div class="mb-4">
    <label for="tags" class="inline-flex items-center gap-x-2 font-bold mb-2"><span
            class="w-2 h-2 bg-white inline-block"></span>Genre</label>
    <select name="tags[]" id="tags" multiple
            class="rounded-xl bg-white/10 border border-white/10 px-5 py-2 w-full">
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    <p class="text-xs text-gray-400 mt-1">Hold Ctrl to select multiple genres</p>
</div>
