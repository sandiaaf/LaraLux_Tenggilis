<?php

namespace App\Http\Controllers;

use App\Models\Facilitie;
use App\Models\Product;
use Illuminate\Http\Request;

class FacilitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facilitie::all();
        $products = Product::all();
        return view('facilitie.index',compact('facilities', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facilitie::all();
        $products = Product::all();
        return view('facilitie.create',compact('facilities', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        $request->validate(['desc'=>'required']);
        $request->validate(['productID'=>'required']);
        
        $newFacilitie = new Facilitie;

        $newFacilitie->name = $request->name;
        $newFacilitie->description = $request->desc;
        $newFacilitie->id_product = $request->productID;


        $newFacilitie->save();
        return redirect()->route('facilitie.index')->with('status','Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facilitie $facilitie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facilities = Facilitie::find($id);
        $products = Product::all();
        return view('facilitie.edit',compact('facilities', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name'=>'required']);
        $request->validate(['desc'=>'required']);
        $request->validate(['productID'=>'required']);
        
        $newFacilitie = Facilitie::find($id);

        $newFacilitie->name = $request->name;
        $newFacilitie->description = $request->desc;
        $newFacilitie->id_product = $request->productID;


        $newFacilitie->save();
        return redirect()->route('facilitie.index')->with('status','Data berhasil masuk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $facilities = Facilitie::find($id);
            $facilities->delete();

            return redirect()->route('facilitie.index')->with('status','Data berhasil dihapus');
        }catch(\Throwable $th){
            $msg="Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('facilitie.index')->with('status',$msg);
        }
    }

    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Facilitie::find($id);
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>view('facilitie.getEditForm',compact('data'))->render()
        ),200);
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = Facilitie::find($id);
        $data->delete();
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>'Facilitie data is removed!'
        ),200);
    }
}
