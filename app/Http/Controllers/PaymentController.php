<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::all(); // Mengambil semua data order
        return view('payments.create', compact('orders')); // Menampilkan halaman form untuk membuat pembayaran baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'method' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Membuat pembayaran baru
        Payment::create([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'date' => $request->date,
        ]);

        // Redirect ke halaman daftar pembayaran dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('order');
        return view('payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id); // Mengambil data pembayaran berdasarkan ID
        $orders = Order::all(); // Mengambil semua data order
        return view('payments.edit', compact('payment', 'orders')); // Menampilkan halaman edit dengan data pembayaran
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'method' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Mengupdate pembayaran
        $payment = Payment::findOrFail($id);
        $payment->update([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'date' => $request->date,
        ]);

        // Redirect ke halaman daftar pembayaran dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}