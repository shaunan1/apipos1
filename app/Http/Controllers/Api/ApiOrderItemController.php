<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem; // Import model OrderItem
use Illuminate\Http\Request;

class ApiOrderItemController extends Controller
{
    public function index()
    {
        // Mengambil semua item pesanan
        $orderItems = OrderItem::all();
        return response()->json($orderItems);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Menyimpan item pesanan baru
        $orderItem = OrderItem::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'subtotal' => $request->subtotal,
        ]);

        return response()->json($orderItem, 201); // Mengembalikan item pesanan yang baru dibuat
    }

    public function show($id)
    {
        // Mengambil item pesanan berdasarkan ID
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        return response()->json($orderItem);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Mengambil item pesanan berdasarkan ID
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        // Memperbarui item pesanan
        $orderItem->order_id = $request->order_id;
        $orderItem->product_id = $request->product_id;
        $orderItem->quantity = $request->quantity;
        $orderItem->subtotal = $request->subtotal;
        $orderItem->save();

        return response()->json($orderItem);
    }

    public function destroy($id)
    {
        // Mengambil item pesanan berdasarkan ID
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        // Menghapus item pesanan
        $orderItem->delete();

        return response()->json(['message' => 'Order item deleted successfully']);
    }
}