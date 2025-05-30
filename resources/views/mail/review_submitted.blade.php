<h2>New Review Submitted</h2>

<p><strong>User:</strong> {{ $review->user->name }}</p>
<p><strong>Book:</strong> {{ $review->book->title }}</p>
<p><strong>Review:</strong></p>
<p>{{ $review->body }}</p>

<p>
    <a href="{{ url('/admin/reviews') }}" style="color:blue">
        Review Moderation Page
    </a>
</p>
