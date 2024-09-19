<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Car;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('backend.management.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('maintenances.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string',
            'maintenance_date' => 'required|date',
            'cost' => 'required|numeric',
        ]);

        Maintenance::create($validated);
        return redirect()->route('maintenances.index')->with('success', 'Maintenance record created successfully.');
    }

    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $cars = Car::all();
        return view('maintenances.edit', compact('maintenance', 'cars'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string',
            'maintenance_date' => 'required|date',
            'cost' => 'required|numeric',
        ]);

        $maintenance->update($validated);
        return redirect()->route('maintenances.index')->with('success', 'Maintenance record updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance record deleted successfully.');
    }
}
