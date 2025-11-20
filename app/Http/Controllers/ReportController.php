<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Transaction;

class ReportController extends Controller
{
    // Menampilkan laporan stok dan transaksi
    public function index()
    {
        $products = Product::all();
        $stockins = StockIn::all();
        $stockouts = StockOut::all();
        $transactions = Transaction::all();

        return view('reports.index', compact('products', 'stockins', 'stockouts', 'transactions'));
    }

    // Tambahkan keterangan pada laporan (khusus kasir)
    public function addNote(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:transactions,id',
            'note' => 'required|string|max:255',
        ]);

        $transaction = Transaction::findOrFail($request->report_id);
        $transaction->note = $request->note;
        $transaction->save();

        return redirect()->route('reports.index')->with('success', 'Keterangan berhasil ditambahkan');
    }
}
