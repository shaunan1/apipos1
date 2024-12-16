<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create'); // Menampilkan halaman form untuk membuat produk baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Membuat produk baru
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Mengambil data produk berdasarkan ID
        return view('products.edit', compact('product')); // Menampilkan halaman edit dengan data produk
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Mengupdate produk
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}