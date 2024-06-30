<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()//menampilkan data pake ini
    {
        $products = Product::select('products.*')
        ->join('product_transaction', 'products.id', '=', 'product_transaction.product_id')
        ->selectRaw('SUM(product_transaction.quantity) as total_quantity')
        ->groupBy('products.id', 'products.name', 'products.type_room', 'products.hotel_id', 'products.created_at', 'products.updated_at', 'products.price', 'products.image', 'products.available_room')
        ->orderByDesc('total_quantity')
        ->get();

        $customers = Customer::orderBy('poin', 'desc')->get();
        
        $transactions = Transaction::select('customer_id')
        ->selectRaw('COUNT(*) as transaction_count')
        ->groupBy('customer_id')
        ->orderByDesc('transaction_count')
        ->get();

        return view('report.index', compact('products','customers','transactions'));
    }
}
