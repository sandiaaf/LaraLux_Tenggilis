<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $users = User::all();
        return view('customer.index',['dataku' => $customers,'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('customer.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['customerName'=>'required']);
        $request->validate(['address'=>'required']);
        $request->validate(['userID'=>'required']);
        
        $newCustomer = new Customer();

        $newCustomer->name = $request->customerName;
        $newCustomer->address = $request->address;
        $newCustomer->user_id = $request->userID;

        $newCustomer->save();
        return redirect()->route('customer.index')->with('status','Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('customer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['customerName'=>'required']);
        $request->validate(['address'=>'required']);

        $newCustomer = Customer::find($id);
        $newCustomer->name = $request->customerName;
        $newCustomer->address = $request->address;

        $newCustomer->save();
        return redirect()->route('customer.index')->with('status','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $customer = Customer::find($id);
            $customer->delete();

            return redirect()->route('customer.index')->with('status','Data berhasil dihapuus');
        }catch(\Throwable $th){
            $msg="Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('customer.index')->with('status',$msg);
        }
        
    }
    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Customer::find($id);
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>view('customer.getEditForm',compact('data'))->render()
        ),200);
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = Customer::find($id);
        $data->delete();
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>'customer data is removed!'
        ),200);
    }

}
