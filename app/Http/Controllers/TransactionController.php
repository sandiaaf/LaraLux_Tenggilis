<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Transaction::all();
        $customers = Customer::all();
        $users = User::all();
        return view('transaction.transaction', ['data' => $data, 'customers' => $customers, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        return view('transaction.create', ['customers' => $customers, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['customerID' => 'required']);
        $request->validate(['userID' => 'required']);
        $request->validate(['transactionDate' => 'required']);

        $newTransaction = new Transaction;

        $newTransaction->customer_id = $request->customerID;
        $newTransaction->user_id = $request->userID;
        $newTransaction->transaction_date = $request->transactionDate;

        $newTransaction->save();
        return redirect()->route('transaction.index')->with('status', 'Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Transaction::find($id);
        $customers = Customer::all();
        $users = User::all();
        return view('transaction.edit', ['data' => $data, 'customers' => $customers, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['customerID' => 'required']);
        $request->validate(['userID' => 'required']);

        $newTransaction = Transaction::find($id);
        $newTransaction->customer_id = $request->customerID;
        $newTransaction->user_id = $request->userID;

        $newTransaction->save();
        return redirect()->route('transaction.index')->with('status', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $type = Transaction::find($id);
            $type->delete();

            return redirect()->route('transaction.index')->with('status', 'Data berhasil dihapuus');
        } catch (\Throwable $th) {
            $msg = "Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('transaction.index')->with('status', $msg);
        }
    }
    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $customers = Customer::all();
        $users = User::all();

        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transaction.getEditForm', compact('data', 'customers', 'users'))->render()
        ), 200);
    }
    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'transaction data is removed!'
        ), 200);
    }
    public function checkout()
    {
        $cart = session('cart');
        $user = Auth::user();
        $t = new Transaction();
        $t->user_id = $user->id;
        $t->customer_id = 1;
        $t->transaction_date = Carbon::now()->toDateTimeString();
        $t->save();
        $t->insertProducts($cart, $user);
        session()->forget('cart');
        return redirect()->route('laralux.index')->with('status', 'Checkout berhasil');
    }
}
