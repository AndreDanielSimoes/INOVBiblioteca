<?php

namespace App\Http\Controllers;

use App\Mail\BookAvailable;
use App\Mail\RequestConfirmation;
use App\Mail\ReturnReminderEmail;
use App\Models\Book;
use App\Models\BookNotification;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequisitionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'active_requests' => Requisition::whereDate('delivery_date', '>=', now())->count(),
            'last_30_days'    => Requisition::where('requested_at', '>=', now()->subDays(30))->count(),
            'delivered_today' => Requisition::whereDate('delivery_date', now())->count(),
        ];

        if ($user->isAdmin()) {
            $requisitions = Requisition::with(['book', 'user'])
                ->latest()
                ->get();
        } else {
            $activeRequisitions = Requisition::where('user_id', $user->id)
                ->where('active', true)
                ->with('book')
                ->latest()
                ->get();

            $pastRequisitions = Requisition::where('user_id', $user->id)
                ->where('active', false)
                ->with('book')
                ->latest()
                ->get();
        }

        $availableBooks = Book::whereDoesntHave('requisitions', function ($query) {
            $query->whereDate('delivery_date', '>=', now());
        })->get();

        return view('requisitions.index', array_filter([
            'requisitions' => $requisitions ?? null,
            'inactiveRequisitions' => $inactiveRequisitions ?? null,
            'activeRequisitions' => $activeRequisitions ?? null,
            'pastRequisitions' => $pastRequisitions ?? null,
            'availableBooks' => $availableBooks,
            'stats' => $stats,
        ]));
    }


    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->isRequested()) {
            return back()->withErrors(['book_id' => 'This book is currently unavailable.']);
        }

        $activeCount = $user->requisitions()
            ->where('active', true)
            ->count();

        if ($activeCount >= 3) {
            return back()->withErrors(['limit' => 'You already have 3 active requests.']);
        }

        $now = now();
        $deliveryDate = $now->copy()->addDays(5);

        $requisition = Requisition::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'requested_at' => $now,
            'delivery_date' => $deliveryDate,
        ]);



        Mail::to($user)->queue(new RequestConfirmation($requisition));


        User::where('role', 1)
            ->where('id', '!=', $user->id)
            ->each(fn($admin) =>
            Mail::to($admin->email)->queue(new RequestConfirmation($requisition))
            );

        return redirect('/requisitions');
    }


    public function toggleActive(\App\Models\Requisition $requisition)
    {
        $requisition->active = !$requisition->active;
        $requisition->save();

        if (!$requisition->active) {
            $book = $requisition->book;

            $notifications = BookNotification::where('book_id', $book->id)->with('user')->get();

            foreach ($notifications as $notification) {
                Mail::to($notification->user)->queue(new BookAvailable($book));

                $notification->delete();
            }
        }

        return back()->with('success', 'Requisition status updated.');
    }


    public function dispatchReturnReminderEmails()
    {
        $requisitions = Requisition::with(['user', 'book'])
            ->whereDate('delivery_date', now()->addDay())
            ->get();

        foreach ($requisitions as $requisition) {
            Mail::to($requisition->user)->queue(new ReturnReminderEmail($requisition));
        }

        return response()->json(['message' => 'Return reminder emails dispatched successfully.']);
    }


}
