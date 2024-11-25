<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendWelcomeEmail;

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

        $client = Client::create($validated);

        SendWelcomeEmail::dispatch($client);

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
            'city'  => 'nullable|max:255|string',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client, WeatherService $weatherService)
    {
        $weather = $client->city ? $weatherService->getWeatherByCity($client->city) : null;

        return view('clients.show', compact('client', 'weather'));
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
