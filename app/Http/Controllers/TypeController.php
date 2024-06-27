<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('type.index',['dataku' => $types]);
    }
    public function create()
    {
        return view('type.create');
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(['typeName'=>'required']);
        $newType = new Type;
        $newType->name = $request->typeName; //cara 1
        //$newType->name = $request->get("typeName"); cara2
        $newType->save();

        // dd($newType); //debug
        return redirect()->route('hotel.index')->with('status','Data berhasil masuk');
    }
    public function show(Type $type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Type::find($id);
        return view('type.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // echo "Masukkk".$id;
        $request->validate(['typeName'=>'required']);
        $newType = Type::find($id);
        $newType->name = $request->typeName;

        $newType->save();
        return redirect()->route('type.index')->with('status','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $this->authorize('delete-permission',$user);
            
        try{
            $type = Type::find($id);
            $type->delete();

            return redirect()->route('type.index')->with('status','Data berhasil dihapuus');
        }catch(\Throwable $th){
            $msg="Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('type.index')->with('status',$msg);
        }
        
    }
    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>view('type.getEditForm',compact('data'))->render()
        ),200);
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = Type::find($id);
        $data->delete();
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>'type data is removed!'
        ),200);
    }
}
