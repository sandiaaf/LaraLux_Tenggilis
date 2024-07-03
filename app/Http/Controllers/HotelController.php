<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Type;
use Illuminate\Http\Request;
use DB;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()//menampilkan data pake ini
    {
        $hotels = Hotel::all();
        return view('hotel.index',['dataku' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('hotel.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['hotelName'=>'required']);
        $request->validate(['address'=>'required']);
        $request->validate(['phone'=>'required']);
        $request->validate(['email'=>'required']);
        $request->validate(['rating'=>'required']);
        $request->validate(['image'=>'required']);
        $request->validate(['typeID'=>'required']);
        
        $newHotel = new Hotel;

        $newHotel->name = $request->hotelName;
        $newHotel->address = $request->address;
        $newHotel->phone = $request->phone;
        $newHotel->email = $request->email;
        $newHotel->rating = $request->rating;
        $newHotel->image = $request->image;
        $newHotel->type_id = $request->typeID;


        $newHotel->save();

        
        $file=$request->file("image");
        $folder='images';
        $filename=time()."_".$file->getClientOriginalName();
        $file->move($folder,$filename);
        $newHotel->image=$filename;
        $newHotel->save();

        return redirect()->route('hotel.index')->with('status','Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Hotel::find($id);
        $types = Type::all();
        return view('hotel.edit', ['data'=>$data, 'types'=>$types]);
        // return view('hotel.edit', compact('data','types'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['hotelName'=>'required']);
        $request->validate(['address'=>'required']);
        $request->validate(['phone'=>'required']);
        $request->validate(['email'=>'required']);
        $request->validate(['rating'=>'required']);
        $request->validate(['image'=>'required']);
        $request->validate(['typeID'=>'required']);
        
        $newHotel = Hotel::find($id);

        $newHotel->name = $request->hotelName;
        $newHotel->address = $request->address;
        $newHotel->phone = $request->phone;
        $newHotel->email = $request->email;
        $newHotel->rating = $request->rating;
        $newHotel->image = $request->image;
        $newHotel->type_id = $request->typeID;
        
        $file = $request->file('image');
        $folder = 'images';
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path($folder), $filename);
        $newHotel->image = $filename;

        $newHotel->save();


        return redirect()->route('hotel.index')->with('status','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $hotel = Hotel::find($id);
            $hotel->delete();

            return redirect()->route('hotel.index')->with('status','Data berhasil dihapuus');
        }catch(\Throwable $th){
            $msg="Tidak bisa dihapuus, data sudah digunakan";
            return redirect()->route('hotel.index')->with('status',$msg);
        }
        
    }
    public function availableHotelRoom(){
        $data = Hotel::join('products as p', 'hotels.id', '=','p.hotel_id')
            ->select('hotels.id','hotels.name', DB::raw('sum(p.available_room) as room'))
            ->groupBy('hotels.id','hotels.name')
            ->get();
        // dd($data);

        return view('hotel.availableRoom', compact('data'));
    }

    public function averagePriceHotel(){
        $data = Type::rightJoin('hotels as h', 'types.id', '=','h.type_id')
            ->leftJoin('products as p', 'h.id', '=','p.hotel_id')
            ->select('types.name as type', 'h.name', DB::raw('IFNULL(AVG(p.price), 0) as avg_price'))
            ->groupBy('types.name', 'h.name')
            ->get();
    
        return view('hotel.averagePrice', compact('data'));
    }
    public function uploadLogo(Request $request)
    {
        $hotel_id=$request->hotel_id;
        $hotel=Hotel::find($hotel_id);
        return view('hotel.formUploadLogo',compact('hotel'));
    }
    public function uploadPhoto(Request $request)
    {
        $hotel_id=$request->hotel_id;
        $hotel=Hotel::find($hotel_id);
        return view('hotel.formUploadPhoto',compact('hotel'));
    }
    public function simpanLogo(Request $request)
    {
        $file=$request->file("file_logo");
        $folder='logo';
        $filename=$request->hotel_id . ".jpg";
        $file->move($folder,$filename);
        return redirect()->route('hotel.index')->with('status','logo terupload');
    }
    public function simpanPhoto(Request $request)
    {
       $file=$request->file("file_photo");
       $folder='images';
       $filename=time()."_".$file->getClientOriginalName();
       $file->move($folder,$filename);
       $hotel=Hotel::find($request->hotel_id);
       $hotel->image=$filename;
       $hotel->save();
       return redirect()->route('hotel.index')->with('status','photo terupload');
    }
    

}
