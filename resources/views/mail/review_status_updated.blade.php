<h2>Your Review Has Been Reviewed</h2>

<p><strong>Book:</strong> {{ $review->book->title }}</p>
<p><strong>Your Review:</strong></p>
<p>{{ $review->body }}</p>

<p><strong>Status:</strong> {{ ucfirst($review->status) }}</p>

@if ($review->status === 'denied' && $review->rejection_reason)
    <p><strong>Reason for Rejection:</strong></p>
    <p>{{ $review->rejection_reason }}</p>
@endif

<p>
    <a href="{{ url('/books/' . $review->book->id) }}" style="color:blue">
        View Book Page
    </a>
</p>



