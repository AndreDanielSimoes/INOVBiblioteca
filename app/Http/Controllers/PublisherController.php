<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        return view('publishers.index', [
            'publishers' => Publisher::latest()->paginate(8),
        ]);
    }

    public function create()
    {
        return view ('publishers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|url|max:2048',
        ]);

        Publisher::create($validated);

        return redirect('/publishers');
    }

    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', ['publisher' => $publisher]);
    }

    public function update(Request $request, Publisher $publisher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|url|max:2048',
        ]);

        $publisher->update($validated);

        return redirect('/publishers');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect('/publishers');
    }
}
