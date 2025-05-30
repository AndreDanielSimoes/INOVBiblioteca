<div>
    <label for="authors" class="inline-flex items-center gap-x-2 font-bold mb-2"><span
            class="w-2 h-2 bg-white inline-block"></span>Authors</label>

    <select name="authors[]" id="authors" multiple
            class="rounded-xl bg-white/10 border border-white/10 px-5 py-2 w-full">
        @foreach ($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select>

    <p class="text-xs text-gray-400 mt-2">Hold Ctrl to select multiple authors</p>
</div>
