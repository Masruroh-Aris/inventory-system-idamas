<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $stockInTotal = StockIn::sum('quantity');
        $stockOutTotal = StockOut::sum('quantity');
        $transactionTotal = Transaction::sum('total');

        return view('admin.dashboard.index', compact(
            'products', 
            'stockInTotal', 
            'stockOutTotal', 
            'transactionTotal'
        ));
    }
}
