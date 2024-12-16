<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'orderItems'])->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'total_amount' => 'required|numeric',
        ]);

        $order = Order::create($data);
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'orderItems.product', 'payment']);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id); // Mengambil data pesanan berdasarkan ID
        $customers = Customer::all(); // Mengambil semua pelanggan untuk dropdown
        return view('orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'total_amount' => 'required|numeric',
        ]);

        // Mengupdate pesanan
        $order = Order::findOrFail($id);
        $order->update([
            'customer_id' => $request->customer_id,
            'date' => $request->date,
            'total_amount' => $request->total_amount,
        ]);

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}