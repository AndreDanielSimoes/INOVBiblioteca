@php
    $book = $requisition->book;
@endphp

<h2>Book Request Confirmation</h2>

<p>Hi {{ $requisition->user->name }},</p>

<p>Your request for the book <strong>{{ $book->title }}</strong> has been received.</p>

<img src="{{ $book->cover }}" alt="Book cover of {{ $book->title }}" style="max-width: 200px; border-radius: 8px;">

<p><strong>Author(s):</strong> {{ $book->authors->pluck('name')->join(', ') }}</p>
<p><strong>Publisher:</strong> {{ $book->publisher->name }}</p>
<p><strong>Requested At:</strong> {{ $requisition->requested_at->format('F j, Y') }}</p>
<p><strong>Delivery Date:</strong> {{ $requisition->delivery_date->format('F j, Y') }}</p>

<p>Thank you for using our library system!</p>
