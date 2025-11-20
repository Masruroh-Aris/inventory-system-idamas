<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOut;
use App\Models\Product;

class StockOutController extends Controller
{
    // Menampilkan daftar stock out
    public function index()
    {
        $stockouts = StockOut::with('product')->get();
        return view('stockout.index', compact('stockouts'));
    }

    // Form tambah stock out
    public function create()
    {
        $products = Product::all();
        return view('stockout.create', compact('products'));
    }

    // Simpan stock out baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'type' => 'required|string', // misal: penjualan / pemakaian
        ]);

        $product = Product::find($request->product_id);

        if ($request->quantity > $product->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        StockOut::create($request->all());

        // Kurangi stok produk
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('stockout.index')->with('success', 'Stock out berhasil ditambahkan');
    }

    // Form edit stock out
    public function edit($id)
    {
        $stockout = StockOut::findOrFail($id);
        $products = Product::all();
        return view('stockout.edit', compact('stockout', 'products'));
    }

    // Update stock out
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'type' => 'required|string',
        ]);

        $stockout = StockOut::findOrFail($id);
        $product = Product::find($request->product_id);

        // Sesuaikan stok berdasarkan selisih
        $product->stock = $product->stock + $stockout->quantity - $request->quantity;

        if ($product->stock < 0) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
        }

        $product->save();
        $stockout->update($request->all());

        return redirect()->route('stockout.index')->with('success', 'Stock out berhasil diupdate');
    }

    // Hapus stock out
    public function destroy($id)
    {
        $stockout = StockOut::findOrFail($id);
        $product = Product::find($stockout->product_id);

        // Kembalikan stok produk
        $product->stock += $stockout->quantity;
        $product->save();

        $stockout->delete();

        return redirect()->route('stockout.index')->with('success', 'Stock out berhasil dihapus');
    }
}
