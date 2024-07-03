<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Facilitie;

class FrontEndController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.index',compact('products'));
    }
    public function show($id)
    {
        $product = Product::find($id);
       
        $facilities = Facilitie::where('id_product', $id)->get();

        return view('frontend.product-detail', compact('product', 'facilities'));
    }
    public function addToCart($id){
        $product = Product::find($id);
        $cart = session()->get('cart');

        if(!isset($cart[$id])){
            $cart[$id]=[
                'id'=>$id,
                'name'=>$product->name,
                'quantity'=>1,
                'price'=>$product->price,
                'photo'=>$product->image,
            ];
        }else{
            $cart[$id]['quantity']++;
        }
        session()->put('cart',$cart);
        
        return redirect()->back()->with("status","Produk Telah ditambahkan ke Cart");
    }
    public function cart(){
        return view('frontend.cart');
    }
    public function addQuantity(Request $request){
        $id = $request->id;
        $cart = session()->get('cart');
        $product = Product::find($cart[$id]['id']);
        if(isset($cart[$id])){
            $jumlahAwal = $cart[$id]['quantity'];
            $jumlahPesan = $jumlahAwal+1;
            if($jumlahPesan< $product->available_room){
                $cart[$id]['quantity']++;
            }else{
                return redirect()->back()->with('error','Jumlah Pemesanan melebihi total kamar yang tersedia');

            }
            session()->forget('cart');
            session()->put('cart',$cart);
        }
    }
    public function reduceQuantity(Request $request){
        $id = $request->id;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            if($cart[$id]['quantity']>0){
                $cart[$id]['quantity']--;
            }
        }
        session()->forget('cart');
        session()->put('cart',$cart);
    }
    public function deleteFromCart($id){
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        session()->forget('cart');
        session()->put('cart',$cart);
        return redirect()->back()->with('error','Produk Telah dibuang dari Cart');
    }
    
}
