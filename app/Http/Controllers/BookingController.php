<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Customer;
use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('backend.management.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $cars = Car::all();
        $customers = Customer::all();
        $deliveryLocations = DeliveryLocation::all();
        return view('backend.management.bookings.create', compact('cars', 'customers', 'deliveryLocations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_price' => 'required|numeric',
            'status_price' => 'required|in:DP,PAID',
            'status' => 'required|in:booked,in_progress,completed,cancelled',
            'driver_cost' => 'nullable|numeric',
            'fuel_cost' => 'nullable|numeric',
            'toll_cost' => 'nullable|numeric',
            'penalty_amount' => 'nullable|numeric',
            'delivery_cost' => 'nullable|numeric',
        ]);

        Booking::create($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $cars = Car::all();
        $customers = Customer::all();
        return view('bookings.edit', compact('booking', 'cars', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_price' => 'required|numeric',
            'status_price' => 'required|in:DP,PAID',
            'status' => 'required|in:booked,in_progress,completed,cancelled',
            'driver_cost' => 'nullable|numeric',
            'fuel_cost' => 'nullable|numeric',
            'toll_cost' => 'nullable|numeric',
            'penalty_amount' => 'nullable|numeric',
            'delivery_cost' => 'nullable|numeric',
        ]);

        $booking->update($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
