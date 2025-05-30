<?php

namespace App\Http\Controllers;

use App\Mail\ReviewSubmitted;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string|max:2000',
        ]);

        $review = Review::create([
            'user_id' => $request->user()->id,
            'book_id' => $validated['book_id'],
            'body' => $validated['content'],
            'status' => 'suspended',
        ]);

        $review->load(['user', 'book']);

        $admins = User::where('role', 1)->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->queue(new ReviewSubmitted($review));
        }

        return back()->with('success', 'Your review has been submitted and is pending approval.');
    }

    public function adminIndex()
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized');
        }

        $reviews = Review::with(['user', 'book'])->latest()->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function updateStatus(Request $request, Review $review)
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:accepted,denied,suspended',
            'rejection_reason' => 'nullable|string|max:1000',
        ]);

        $review->status = $request->status;
        $review->rejection_reason = $request->status === 'denied' ? $request->rejection_reason : null;
        $review->save();

        Mail::to($review->user->email)->queue(
            new \App\Mail\ReviewStatusUpdated($review)
        );

        return back()->with('success', 'Review status updated.');
    }

}


