<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order; // Import model Order
use Illuminate\Http\Request;

class ApiOrdersController extends Controller
{
    public function index()
    {
        // Mengambil semua pesanan
        $orders = Order::with('customer')->get(); // Mengambil pesanan beserta data pelanggan
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Menyimpan pesanan baru
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'date' => $request->date,
            'total_amount' => $request->total_amount,
        ]);

        return response()->json($order, 201); // Mengembalikan pesanan yang baru dibuat
    }

    public function show($id)
    {
        // Mengambil pesanan berdasarkan ID
        $order = Order::with('customer')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Mengambil pesanan berdasarkan ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Memperbarui pesanan
        $order->customer_id = $request->customer_id;
        $order->date = $request->date;
        $order->total_amount = $request->total_amount;
        $order->save();

        return response()->json($order);
    }

    public function destroy($id)
    {
        // Mengambil pesanan berdasarkan ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Menghapus pesanan
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}