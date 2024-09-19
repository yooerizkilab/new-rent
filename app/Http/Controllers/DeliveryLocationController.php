<?php

namespace App\Http\Controllers;

use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryLocationController extends Controller
{
    public function index()
    {
        $deliveryLocations = DeliveryLocation::all();
        return view('delivery_locations.index', compact('deliveryLocations'));
    }

    public function create()
    {
        return view('delivery_locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:100',
            'description' => 'nullable|string',
            'additional_cost' => 'required|numeric',
        ]);

        DeliveryLocation::create($validated);
        return redirect()->route('delivery_locations.index')->with('success', 'Delivery location created successfully.');
    }

    public function show(DeliveryLocation $deliveryLocation)
    {
        return view('delivery_locations.show', compact('deliveryLocation'));
    }

    public function edit(DeliveryLocation $deliveryLocation)
    {
        return view('delivery_locations.edit', compact('deliveryLocation'));
    }

    public function update(Request $request, DeliveryLocation $deliveryLocation)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:100',
            'description' => 'nullable|string',
            'additional_cost' => 'required|numeric',
        ]);

        $deliveryLocation->update($validated);
        return redirect()->route('delivery_locations.index')->with('success', 'Delivery location updated successfully.');
    }

    public function destroy(DeliveryLocation $deliveryLocation)
    {
        $deliveryLocation->delete();
        return redirect()->route('delivery_locations.index')->with('success', 'Delivery location deleted successfully.');
    }
}
