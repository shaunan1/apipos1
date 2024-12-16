<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create'); // Menampilkan halaman form untuk membuat kategori baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Membuat kategori baru
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id); // Mengambil data kategori berdasarkan ID
        return view('categories.edit', compact('category')); // Menampilkan halaman edit dengan data kategori
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Mengupdate kategori
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}