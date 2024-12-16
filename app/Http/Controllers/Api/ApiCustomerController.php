<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer; // Import model Customer
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    public function index()
    {
        // Mengambil semua pelanggan
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
        ]);

        // Menyimpan pelanggan baru
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json($customer, 201); // Mengembalikan pelanggan yang baru dibuat
    }

    public function show($id)
    {
        // Mengambil pelanggan berdasarkan ID
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $id,
        ]);

        // Mengambil pelanggan berdasarkan ID
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Memperbarui pelanggan
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        return response()->json($customer);
    }

    public function destroy($id)
    {
        // Mengambil pelanggan berdasarkan ID
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Menghapus pelanggan
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}