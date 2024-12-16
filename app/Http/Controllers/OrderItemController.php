<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->get();
        return view('order-items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order::all(); // Mengambil semua data order
        $products = Product::all(); // Mengambil semua data produk
        return view('order-items.create', compact('orders', 'products')); // Menampilkan halaman form untuk membuat order item baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric',
        ]);

        // Membuat order item baru
        OrderItem::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'subtotal' => $request->subtotal,
        ]);

        // Redirect ke halaman daftar order items dengan pesan sukses
        return redirect()->route('order-items.index')->with('success', 'Order item created successfully.');
    }

    public function show(OrderItem $orderItem)
    {
        $orderItem->load(['order', 'product']);
        return view('order-items.show', compact('orderItem'));
    }

    public function edit($id)
    {
        $orderItem = OrderItem::findOrFail($id); // Mengambil data order item berdasarkan ID
        $orders = Order::all(); // Mengambil semua data order
        $products = Product::all(); // Mengambil semua data produk
        return view('order-items.edit', compact('orderItem', 'orders', 'products')); // Menampilkan halaman edit dengan data order item
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric',
        ]);

        // Mengupdate order item
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'subtotal' => $request->subtotal,
        ]);

        // Redirect ke halaman daftar order items dengan pesan sukses
        return redirect()->route('order-items.index')->with('success', 'Order item updated successfully.');
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('order-items.index')->with('success', 'Order item deleted successfully.');
    }
}