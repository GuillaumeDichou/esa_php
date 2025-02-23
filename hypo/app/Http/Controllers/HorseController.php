<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;

class HorseController extends Controller
{
    public function index()
    {
        $horses = Horse::all();
        return view('horses.index', compact('horses'));
    }

    public function create()
    {
        return view('horses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:horses|max:255',
            'max_working_hours' => 'required|integer',
            'status' => 'required|in:disponible,indisponible',
        ]);

        Horse::create($validated);
        return redirect()->route('horses.index')->with('success', 'Horse created successfully.');
    }

    public function show(Horse $horse)
    {
        return view('horses.show', compact('horse'));
    }

    public function edit(Horse $horse)
    {
        return view('horses.edit', compact('horse'));
    }

    public function update(Request $request, Horse $horse)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:horses,name,' . $horse->id,
            'max_working_hours' => 'required|integer',
            'status' => 'required|in:disponible,indisponible',
        ]);

        $horse->update($validated);
        return redirect()->route('horses.index')->with('success', 'Horse updated successfully.');
    }

    public function destroy(Horse $horse)
    {
        $horse->delete();
        return redirect()->route('horses.index')->with('success', 'Horse deleted successfully.');
    }
}
