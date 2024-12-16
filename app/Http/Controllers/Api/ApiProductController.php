<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Menyimpan produk baru
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return response()->json($product, 201); // Mengembalikan produk yang baru dibuat
    }

    public function show($id)
    {
        // Mengambil produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Mengambil produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Memperbarui produk
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        // Mengambil produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Menghapus produk
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}