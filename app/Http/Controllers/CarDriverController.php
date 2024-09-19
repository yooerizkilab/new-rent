<?php

namespace App\Http\Controllers;

use App\Models\CarDriver;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;

class CarDriverController extends Controller
{
    public function index()
    {
        $carDrivers = CarDriver::all();
        return view('car_drivers.index', compact('carDrivers'));
    }

    public function create()
    {
        $cars = Car::all();
        $drivers = Driver::all();
        return view('car_drivers.create', compact('cars', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        CarDriver::create($validated);
        return redirect()->route('car_drivers.index')->with('success', 'Car-Driver assignment created successfully.');
    }

    public function show(CarDriver $carDriver)
    {
        return view('car_drivers.show', compact('carDriver'));
    }

    public function edit(CarDriver $carDriver)
    {
        $cars = Car::all();
        $drivers = Driver::all();
        return view('car_drivers.edit', compact('carDriver', 'cars', 'drivers'));
    }

    public function update(Request $request, CarDriver $carDriver)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $carDriver->update($validated);
        return redirect()->route('car_drivers.index')->with('success', 'Car-Driver assignment updated successfully.');
    }

    public function destroy(CarDriver $carDriver)
    {
        $carDriver->delete();
        return redirect()->route('car_drivers.index')->with('success', 'Car-Driver assignment deleted successfully.');
    }
}
