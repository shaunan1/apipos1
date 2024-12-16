<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category; // Import model Category
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Menyimpan kategori baru
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201); // Mengembalikan kategori yang baru dibuat
    }

    public function show($id)
    {
        // Mengambil kategori berdasarkan ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Mengambil kategori berdasarkan ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Memperbarui kategori
        $category->name = $request->name;
        $category->save();

        return response()->json($category);
    }

    public function destroy($id)
    {
        // Mengambil kategori berdasarkan ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Menghapus kategori
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}