<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;
use App\Models\Product;

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
        return view('transaction.transaction',['data'=>$data,'customers'=>$customers, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        return view('transaction.create', ['customers'=>$customers, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['customerID'=>'required']);
        $request->validate(['userID'=>'required']);
        $request->validate(['transactionDate'=>'required']);
        $request->validate(['tax'=>'required']);

        $newTransaction = new Transaction;
        
        $newTransaction->customer_id = $request->customerID;
        $newTransaction->user_id = $request->userID;
        $newTransaction->transaction_date = $request->transactionDate;
        $newTransaction->tax = $request->tax;

        $newTransaction->save();
        return redirect()->route('transaction.index')->with('status','Data berhasil masuk');
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
        return view('transaction.edit', ['data'=>$data, 'customers'=>$customers, 'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['customerID'=>'required']);
        $request->validate(['userID'=>'required']);

        $newTransaction = Transaction::find($id);
        $newTransaction->customer_id = $request->customerID;
        $newTransaction->user_id = $request->userID;

        $newTransaction->save();
        return redirect()->route('transaction.index')->with('status','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $type = Transaction::find($id);
            $type->delete();

            return redirect()->route('transaction.index')->with('status','Data berhasil dihapuus');
        }catch(\Throwable $th){
            $msg="Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('transaction.index')->with('status',$msg);
        }
        
    }


    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Transaction::find($id);
        $customers = Customer::all();
        $users = User::all();

        return response()->json(array(
            'status'=> 'oke',
            'msg' =>view('transaction.getEditForm',compact('data','customers','users'))->render()
        ),200);
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = Transaction::find($id);
        $data->delete();
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>'transaction data is removed!'
        ),200);
    }

    public function insertPointByCustomerId($id, $point)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->poin += $point;
            $customer->save();
        } else {
            dd($id);
        }
    }
    
    //////////////////////////////////////////////////////////////////////
    public function checkout()
    {
        $cart = session('cart');
        $user = Auth::user();
        $customers = Customer::all();
        $customerId = 0;
        $customerNow = 0;
        $pointRedem=0;
        $currentPoint=0;
        $point = 0;
        $totalFinal=0;
        $totalFinalRedem=0;

        foreach($customers as $c){
            if($c->user_id == $user->id){
                $customerId = $c->id;
                $currentPoint = $c->poin;
                break;
            }
        }
        if ($customerId == 0) {
            $newCustomer = new Customer();

            $newCustomer->name = $user->name;
            $newCustomer->address = $user->address;
            $newCustomer->poin = $point;
            $newCustomer->user_id = $user->id;
            $newCustomer->save();

            $customerId = $newCustomer->id;
            $currentPoint = $newCustomer->poin;
        }



        $t = new Transaction();
        $t->user_id = $user->id;
        $t->customer_id = $customerId;
        $t->transaction_date = Carbon::now()->toDateTimeString();
        $t->save();
        $t->insertProducts($cart, $user);
    
        $products = Product::all()->keyBy('id');

        $roomTypes = [];

        foreach ($cart as $item) {
            $totalFinalRedem += $item['price'] * $item['quantity'];
        }

        if($totalFinalRedem>=100000){
            //PEMBULATAN KEBAWAH
            if($currentPoint == 0){

            }else{
                $pointRedem += floor($totalFinalRedem / 100000);
                $newPoint = $currentPoint - $pointRedem;
                $customerNow = Customer::find($customerId);
    
                if ($customerNow) {
                    $customerNow->poin = $newPoint;
                    $customerNow->save();
                } else {
    
                }
            }

        }
        foreach ($cart as $item) {
            if (isset($products[$item['id']])) {
                if (isset($item['price']) && isset($item['quantity'])) {
                    $totalFinal += $item['price'] * $item['quantity'];
                }
                $roomTypes[] = $products[$item['id']]->type_room;
    
                if ($products[$item['id']]->type_room == 'Deluxe' || 
                    $products[$item['id']]->type_room == 'Superior' || 
                    $products[$item['id']]->type_room == 'Suite') {
                    $point += 5 * $item['quantity'];
                    $totalFinal -= $item['price'];
                } else {
                    if ($totalFinal >= 300000) {
                        $totalFinalAfterTax = $totalFinal + ($totalFinal * 0.11);
                        //PEMBULATAN KEBAWAH
                        $point += floor($totalFinalAfterTax / 300000);
                    }
                }
            } else {
                dd("Product ID not found: " . $item['id']);
            }
        }

        $this->insertPointByCustomerId($t->customer_id, $point);

        

        session()->forget('cart');
        return redirect()->route('laralux.index')->with('status', 'Checkout berhasil');
    }
    
}
