<h1>Return Reminder</h1>

<p>Hello {{ $requisition->user->name }},</p>

<p>This is a reminder to return the book <strong>{{ $requisition->book->title }}</strong> by <strong>{{ $requisition->delivery_date->format('F j, Y') }}</strong>.</p>

<img src="{{ $requisition->book->cover }}" alt="Book cover" style="max-height: 200px; border-radius: 8px;">

<p>Thank you!</p>
