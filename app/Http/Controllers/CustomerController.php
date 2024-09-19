<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('backend.management.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('backend.management.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|string|max:100',
            'photo' => 'nullable|image',
            'photo_idcard' => 'nullable|image',
        ]);

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'address' => 'required|string|max:100',
            'photo' => 'nullable|image',
            'photo_idcard' => 'nullable|image',
        ]);

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
