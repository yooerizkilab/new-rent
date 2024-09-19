<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('backend.management.mobil.index', compact('cars'));
    }

    public function create()
    {
        return view('backend.management.mobil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer',
            'color' => 'required|string|max:50',
            'transmission' => 'nullable|string|max:50',
            'fuel' => 'nullable|string|max:50',
            'mileage' => 'nullable|string|max:50',
            'baggage' => 'nullable|string|max:50',
            'seat' => 'nullable|string|max:50',
            'feature' => 'nullable|string|max:50',
            'license_plate' => 'required|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'units' => 'required|integer',
            'status' => 'required|in:available,rented,maintenance',
            'daily_rate' => 'required|numeric',
            'weekly_rate' => 'nullable|numeric',
            'monthly_rate' => 'nullable|numeric',
            'penalty_rate_per_day' => 'nullable|numeric',
        ]);

        Car::create($validated);
        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        return view('backend.management.mobil.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('backend.management.mobil.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer',
            'color' => 'required|string|max:50',
            'transmission' => 'nullable|string|max:50',
            'fuel' => 'nullable|string|max:50',
            'mileage' => 'nullable|string|max:50',
            'baggage' => 'nullable|string|max:50',
            'seat' => 'nullable|string|max:50',
            'feature' => 'nullable|string|max:50',
            'license_plate' => 'required|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'units' => 'required|integer',
            'status' => 'required|in:available,rented,maintenance',
            'daily_rate' => 'required|numeric',
            'weekly_rate' => 'nullable|numeric',
            'monthly_rate' => 'nullable|numeric',
            'penalty_rate_per_day' => 'nullable|numeric',
        ]);

        $car->update($validated);
        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
