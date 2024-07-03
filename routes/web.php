<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FacilitieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/',[HotelController::class, 'index'])->middleware('auth');

Route::resource('hotel',HotelController::class)->middleware('auth');

Route::get('report/availableHotelRooms',[HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');

Route::get('report/hotel/avgPriceByHotelType',[HotelController::class, 'averagePriceHotel']);

Route::get('hotel/uploadLogo/{hotel_id}', [HotelController::class, 'uploadLogo']);
Route::post('hotel/simpanLogo',[HotelController::class, 'simpanLogo']);

Route::get('hotel/uploadPhoto/{hotel_id}', [HotelController::class, 'uploadPhoto']);
Route::post('hotel/simpanPhoto',[HotelController::class, 'simpanPhoto']);

// Route::get('/product/{id}', [ProductController::class, 'show']);

Route::resource('transaction',TransactionController::class)->middleware('auth');
Route::resource('type',TypeController::class)->middleware('auth');
Route::resource('customer',CustomerController::class)->middleware('auth');
Route::resource('product',ProductController::class)->middleware('auth');
Route::resource('facilitie',FacilitieController::class)->middleware('auth');

Route::post('facilitie/getEditForm',[FacilitieController::class,'getEditForm'])->name('facilitie.getEditForm');
Route::post('facilitie/deleteData',[FacilitieController::class,'deleteData'])->name('facilitie.deleteData');


Route::post('type/getEditForm',[TypeController::class,'getEditForm'])->name('type.getEditForm');
Route::post('type/deleteData',[TypeController::class,'deleteData'])->name('type.deleteData');

Route::post('customer/getEditForm',[CustomerController::class,'getEditForm'])->name('customer.getEditForm');
Route::post('customer/deleteData',[CustomerController::class,'deleteData'])->name('customer.deleteData');

Route::post('product/getEditForm',[ProductController::class,'getEditForm'])->name('product.getEditForm');
Route::post('product/deleteData',[ProductController::class,'deleteData'])->name('product.deleteData');

Route::get('product/uploadPhoto/{product_id}', [ProductController::class, 'uploadPhoto']);
Route::post('product/simpanPhoto',[ProductController::class, 'simpanPhoto']);
Route::post('product/delPhoto',[ProductController::class, 'delPhoto']);

Route::post('transaction/getEditForm',[TransactionController::class,'getEditForm'])->name('transaction.getEditForm');
Route::post('transaction/deleteData',[TransactionController::class,'deleteData'])->name('transaction.deleteData');

Route::get('facilitie/create',[FacilitieController::class,'create'])->name('facilitie.create');

Route::get('/laralux',[FrontEndController::class,'index'])->name('laralux.index');
Route::get('/laralux/{laralux}',[FrontEndController::class,'show'])->name('laralux.show');

Route::middleware(['auth'])->group(function(){
    Route::get('laralux/user/cart',function(){
        return view('frontend.cart');
    })->name('cart');
    Route::get('laralux/cart/add/{id}',[FrontEndController::class,'addToCart'])->name('addCart');
    Route::get('laralux/cart/delete/{id}',[FrontEndController::class,'deleteFromCart'])->name('delFromCart');

    Route::post('laralux/cart/addQty',[FrontEndController::class,'addQuantity'])->name('addQty');
    Route::post('laralux/cart/reduceQty',[FrontEndController::class,'reduceQuantity'])->name('redQty');
    Route::get('laralux/cart/checkout',[TransactionController::class,'checkout'])->name('checkout');
});

Route::get('/hotel/{opsi}', function ($opsi) {
    if($opsi !=""){
        return view('hotel',['name'=>$opsi]);
    }else{
        return view('hotel');
    }
});

Route::get('/kategori/{opsi?}', function ($opsi='') {
    if($opsi == ""){
        $kategoris = array(
            array(
                'image' => 'https://ak-d.tripcdn.com/images/0580912000cz0httm78E0_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Single',
                'url' => '/kategori/single'
            ),
            array(
                'image' => 'https://ak-d.tripcdn.com/images/1mc1w12000b5l0q1n177B_W_1280_853_R5.webp',
                'name' => 'Single Semi Double',
                'url' => '/kategori/single-semi-double'
            ),
            array(
                'image' => 'https://ak-d.tripcdn.com/images/220s0r000000h4s1j6536_W_1280_853_R5.webp',
                'name' => 'Standard Double',
                'url' => '/kategori/standard-double'
            )
        );
        return view('hotel', ['kategoris' => $kategoris]);

    }elseif($opsi == "single"){
        $hotels = array(
            array(
                'image' => 'https://ak-d.tripcdn.com/images/0585a12000dbr87eh9ED5_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Hotel Cowok Single',
                'desc' => 'Kamar Single dengan indahnya pemandangan'
            ),
            array(
                'image' => 'https://ak-d.tripcdn.com/images/0206n120008dpowl6141F_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Hotel Yey Single',
                'desc' => 'Kamar Single dengan fasilitas lengkap'
            ),
            array(
                'image' => 'https://ak-d.tripcdn.com/images/0586712000d50kn7l4B33_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Hotel Tono Single',
                'desc' => 'Kamar Single dengan makanan gratis'
            )
            );
        return view('hotel', ['kategori'=> $opsi,'hotels' => $hotels]);
    }elseif($opsi == "single-semi-double"){
        return 'Daftar Kamar Hotel Kategori single-semi-double';
    }elseif($opsi == "standard-double"){
        $hotels = array(
            array(
                'image' => 'https://ak-d.tripcdn.com/images/02251120009zv1cxu1250_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Hotel Tresno',
                'desc' => 'Kamar Double Standar dengan indahnya pemandangan'
            ),
            array(
                'image' => 'https://ak-d.tripcdn.com/images/0583f12000cuqnohzFD06_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Hotel Jaya',
                'desc' => 'Kamar Double Standar dengan fasilitas lengkap'
            ),
            array(
                'image' => 'https://ak-d.tripcdn.com/images/0205812000924ur8168F4_W_1280_853_R5.webp?proc=watermark/image_trip1,l_ne,x_16,y_16,w_67,h_16;digimark/t_image,logo_tripbinary;ignoredefaultwm,1A8F',
                'name' => 'Hotel Krakatau',
                'desc' => 'Kamar Double Standar dengan makanan gratis'
            )
        );
        return view('hotel', ['kategori'=> $opsi,'hotels' => $hotels]);
    }
    
});

Route::get('/promo/{opsi}', function ($opsi) {
    if($opsi == "Promo-Ramadhan"){
        return 'Deskripsi Detail promo Promo-sRamadhan';
    }
});



Route::get('/user/{name?}', function ($name='Sandi') {
    return 'User '.$name;
});

Route::get('/user/{name?}', function ($name='All') {
    if ($name == 'All'){
        $names = array("Sandi", "Dhani");
        return json_encode($names);
    }
    else{
        return 'User '.$name;
    }
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
