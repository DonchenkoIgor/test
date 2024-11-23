<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('status')){
            $query->where('status', $request->status);
        }

        $clients = $query->paginate(5);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|max:255|string',
            'register_at' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|max:20|string',
            'register_at' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
