<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockIn;
use App\Models\Product;

class StockInController extends Controller
{
    // Menampilkan daftar stock in
    public function index()
    {
        $stockins = StockIn::with('product')->get(); // Relasi ke produk
        return view('stockin.index', compact('stockins'));
    }

    // Form tambah stock in
    public function create()
    {
        $products = Product::all();
        return view('stockin.create', compact('products'));
    }

    // Simpan stock in baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        StockIn::create($request->all());

        // Update stok produk
        $product = Product::find($request->product_id);
        $product->stock += $request->quantity;
        $product->save();

        return redirect()->route('stockin.index')->with('success', 'Stock in berhasil ditambahkan');
    }

    // Form edit stock in
    public function edit($id)
    {
        $stockin = StockIn::findOrFail($id);
        $products = Product::all();
        return view('stockin.edit', compact('stockin', 'products'));
    }

    // Update stock in
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $stockin = StockIn::findOrFail($id);

        // Update stok produk sesuai selisih jumlah
        $product = Product::find($request->product_id);
        $product->stock = $product->stock - $stockin->quantity + $request->quantity;
        $product->save();

        $stockin->update($request->all());

        return redirect()->route('stockin.index')->with('success', 'Stock in berhasil diupdate');
    }

    // Hapus stock in
    public function destroy($id)
    {
        $stockin = StockIn::findOrFail($id);

        // Kurangi stok produk
        $product = Product::find($stockin->product_id);
        $product->stock -= $stockin->quantity;
        $product->save();

        $stockin->delete();

        return redirect()->route('stockin.index')->with('success', 'Stock in berhasil dihapus');
    }
}
