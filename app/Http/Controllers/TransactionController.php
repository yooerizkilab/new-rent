<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Booking;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('backend.management.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $bookings = Booking::all();
        return view('transactions.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rental_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:credit_card,bank_transfer,cash,digital_wallet',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,completed,failed',
            'snap_token' => 'nullable|string|max:100',
        ]);

        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $bookings = Booking::all();
        return view('transactions.edit', compact('transaction', 'bookings'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'rental_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:credit_card,bank_transfer,cash,digital_wallet',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,completed,failed',
            'snap_token' => 'nullable|string|max:100',
        ]);

        $transaction->update($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
