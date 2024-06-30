<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Hotel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        $hotels = Hotel::all();

        foreach($data as $d)
        {
            $directory = public_path('productImages/'.$d->id);
            if(File::exists($directory))
            {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $d['filenames']=$filenames;
            }
        }
        // dd($data);
        return view('product.index',['data'=>$data,'hotels'=>$hotels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        return view('product.create',compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['productName'=>'required']);
        $request->validate(['typeRoom'=>'required']);
        $request->validate(['hotelID'=>'required']);
        $request->validate(['price'=>'required']);
        $request->validate(['image'=>'required']);
        $request->validate(['availableRoom'=>'required']);
   
        $newProduct = new Product;

        $newProduct->name = $request->productName;
        $newProduct->type_room = $request->typeRoom;
        $newProduct->hotel_id = $request->hotelID;
        $newProduct->price = $request->price;
        $newProduct->image = $request->image;
        $newProduct->available_room = $request->availableRoom;

        $newProduct->save();
        return redirect()->route('product.index')->with('status','Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */

    // public function show(Product $product)
    public function show(string $id)
    {
        $data = Product::find($id);
        // dd($data);

        return view("product.show",compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $hotels = Hotel::all();
        return view('product.edit', ['data'=>$data, 'hotels'=>$hotels]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate(['productName'=>'required']);
        $request->validate(['typeRoom'=>'required']);
        $request->validate(['hotelID'=>'required']);
        $request->validate(['price'=>'required']);
        $request->validate(['image'=>'required']);
        $request->validate(['availableRoom'=>'required']);

        
        $newProduct = Product::find($id);

        $newProduct->name = $request->productName;
        $newProduct->type_room = $request->typeRoom;
        $newProduct->hotel_id = $request->hotelID;
        $newProduct->price = $request->price;
        $newProduct->image = $request->image;
        $newProduct->available_room = $request->availableRoom;



        $newProduct->save();
        return redirect()->route('hotel.index')->with('status','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            $product->delete();

            return redirect()->route('hotel.index')->with('status','Data berhasil dihapuus');
        }catch(\Throwable $th){
            $msg="Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('hotel.index')->with('status',$msg);
        }
        
    }
    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Product::find($id);
        $hotels = Hotel::all();

        return response()->json(array(
            'status'=> 'oke',
            'msg' =>view('product.getEditForm',compact('data','hotels'))->render()
        ),200);
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = Product::find($id);
        $data->delete();
        return response()->json(array(
            'status'=> 'oke',
            'msg' =>'Product data is removed!'
        ),200);
    }
    public function uploadPhoto(Request $request)
    {
        $product_id=$request->product_id;
        $product=Product::find($product_id);
        return view('product.formUploadPhoto',compact('product'));
    }
    public function simpanPhoto(Request $request)
    {
        $file=$request->file("file_photo");
        $folder='productImages/'.$request->product_id;
        @File::makeDirectory(public_path()."/".$folder);
        $filename=time()."_".$file->getClientOriginalName();
        $file->move($folder,$filename);
        return redirect()->route('product.index')->with('status','photo terupload');
    }
    public function delPhoto(Request $request)
    {
        File::delete(public_path()."/".$request->filepath);
        return redirect()->route('product.index')->with('status','photo dihapus');
    }


    
}
