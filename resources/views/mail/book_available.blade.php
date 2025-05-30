<h2>Book Now Available</h2>

<p>Hi there,</p>

<p>The book <strong>{{ $book->title }}</strong> is now available to request!</p>

<img src="{{ $book->cover }}" alt="Book cover of {{ $book->title }}" style="max-width: 200px; border-radius: 8px;">

<p><strong>Author(s):</strong> {{ $book->authors->pluck('name')->join(', ') }}</p>
<p><strong>Publisher:</strong> {{ $book->publisher?->name ?? 'N/A' }}</p>

<p>Visit the library now to request it!</p>

