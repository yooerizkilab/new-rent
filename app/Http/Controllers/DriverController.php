<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'license_number' => 'required|string|max:100',
            'email' => 'required|email|unique:drivers,email',
            'photo' => 'nullable|image',
        ]);

        Driver::create($validated);
        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'license_number' => 'required|string|max:100',
            'email' => 'required|email|unique:drivers,email,' . $driver->id,
            'photo' => 'nullable|image',
        ]);

        $driver->update($validated);
        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
