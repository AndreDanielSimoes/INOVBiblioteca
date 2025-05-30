<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        if (Auth::user()->role !== 1) {
            abort(403, 'Unauthorized access');
        }

        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function toggleRole(User $user)
    {

        if (Auth::user()->role !== 1) {
            abort(403, 'Unauthorized');
        }

        $user->role = $user->role === 1 ? 0 : 1;
        $user->save();

        return redirect('/users')->with('success', 'User role updated.');
    }

    public function show(User $user)
    {

        $requisitions = $user->requisitions()->latest()->get();

        return view('users.show', compact('user', 'requisitions'));
    }
}

