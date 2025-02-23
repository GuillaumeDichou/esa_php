<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Horse;
use App\Models\Invoice;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        $clients = Client::all();
        $horses = Horse::where('status', 'disponible')->get();
        return view('reservations.index', compact('reservations', 'clients', 'horses'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'number_of_people' => 'required|integer',
            'total_price' => 'required|numeric',
            'status' => 'required|in:confirmé,annulé',
            'horses' => 'required|array',
            'horses.*' => 'exists:horses,id',
        ]);

        $reservation = Reservation::create([
            'client_id' => $validated['client_id'],
            'number_of_people' => $validated['number_of_people'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'date' => $validated['date'],
            'total_price' => $validated['total_price'],
            'status' => $validated['status'],
        ]);

        foreach ($validated['horses'] as $horseId) {
            $reservation->horses()->attach($horseId);
        }

        $invoice = Invoice::create([
            'client_id' => $reservation['client_id'],
            'reservation_id' => $reservation['id'],
            'date' => $reservation['date'],
            'amount' => $reservation['total_price'],
            'status' => 'impayée',
        ]);
    
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $clients = Client::all();
        $horses = Horse::where('status', 'disponible')->get();
        return view('reservations.edit', compact('reservation', 'clients', 'horses'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'number_of_people' => 'required|integer',
            'total_price' => 'required|numeric',
            'status' => 'required|in:confirmé,annulé',
        ]);

        $reservation->update($validated);
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
