@props(['book'])

<img src="{{ $book->cover }}" alt="Cover of {{ $book->title }}"
     class="rounded-xl w-[200px] h-[300px] object-cover" />

