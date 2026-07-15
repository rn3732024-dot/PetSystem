<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** Display the administrator pet-record overview. */
    public function __invoke(): View
    {
        return view('dashboard', [
            'totalPets' => Pet::count(),
            'availablePets' => Pet::where('status', 'available')->count(),
            'adoptedPets' => Pet::where('status', 'adopted')->count(),
            'newPetsToday' => Pet::whereDate('created_at', today())->count(),
            'latestPets' => Pet::latest()->take(10)->get(),
        ]);
    }

    /** Store a pet record submitted by an administrator. */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pet_id' => ['required', 'string', 'max:50', 'unique:pets,pet_id'],
            'name' => ['required', 'string', 'max:100'],
            'species' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:available,adopted,foster'],
        ], [
            'pet_id.unique' => 'This Pet ID is already in use.',
        ]);

        Pet::create($validated);

        return to_route('dashboard')->with('success', 'Pet record added successfully.');
    }

    /** Show the edit form for a pet record. */
    public function edit(Pet $pet): View
    {
        return view('pets.edit', compact('pet'));
    }

    /** Update an existing pet record. */
    public function update(Request $request, Pet $pet): RedirectResponse
    {
        $validated = $request->validate([
            'pet_id' => ['required', 'string', 'max:50', Rule::unique('pets', 'pet_id')->ignore($pet)],
            'name' => ['required', 'string', 'max:100'],
            'species' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:available,adopted,foster'],
        ], [
            'pet_id.unique' => 'This Pet ID is already in use.',
        ]);

        $pet->update($validated);

        return to_route('dashboard')->with('success', 'Pet record updated successfully.');
    }

    /** Delete a pet record. */
    public function destroy(Pet $pet): RedirectResponse
    {
        $pet->delete();

        return to_route('dashboard')->with('success', 'Pet record deleted successfully.');
    }
}
