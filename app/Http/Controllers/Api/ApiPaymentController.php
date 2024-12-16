<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment; // Import model Payment
use Illuminate\Http\Request;

class ApiPaymentController extends Controller
{
    public function index()
    {
        // Mengambil semua pembayaran
        $payments = Payment::with('order')->get(); // Mengambil pembayaran beserta data pesanan
        return response()->json($payments);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Menyimpan pembayaran baru
        $payment = Payment::create([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'date' => $request->date,
        ]);

        return response()->json($payment, 201); // Mengembalikan pembayaran yang baru dibuat
    }

    public function show($id)
    {
        // Mengambil pembayaran berdasarkan ID
        $payment = Payment::with('order')->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json($payment);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Mengambil pembayaran berdasarkan ID
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Memperbarui pembayaran
        $payment->order_id = $request->order_id;
        $payment->amount = $request->amount;
        $payment->method = $request->method;
        $payment->date = $request->date;
        $payment->save();

        return response()->json($payment);
    }

    public function destroy($id)
    {
        // Mengambil pembayaran berdasarkan ID
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Menghapus pembayaran
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}