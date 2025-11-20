<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with('product')->get();
        return view('transactions.index', compact('transactions'));
    }

    // Form tambah transaksi
    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::find($request->product_id);

        if ($request->quantity > $product->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        // Buat transaksi
        Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->quantity * $request->price,
        ]);

        // Kurangi stok produk
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat');
    }

    // Form edit transaksi
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = Product::find($request->product_id);

        // Sesuaikan stok berdasarkan selisih
        $product->stock = $product->stock + $transaction->quantity - $request->quantity;

        if ($product->stock < 0) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        $product->save();

        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->quantity * $request->price,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate');
    }

    // Hapus transaksi (hanya admin)
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $product = Product::find($transaction->product_id);

        // Kembalikan stok
        $product->stock += $transaction->quantity;
        $product->save();

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
