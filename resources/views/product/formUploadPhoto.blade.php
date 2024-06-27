@extends('layout.conquer2')
@section('anak')

<div class="m-3">
<div class="page-content">
    <h3 class="page-title">Upload Photo untuk Product {{$product->name}}</h3>
    <div class="container">
       <form method="POST" enctype="multipart/form-data" action="{{url('product/simpanPhoto')}}">
           @csrf
           <div class="form-group">
              <label for="exampleInputType">Pilih Photo</label>
              <input type="file" class="form-control" name="file_photo"/>
              <input type="hidden" name='product_id' value="{{$product->id}}"/>
           </div>
           <button type="submit" class="btn btn-primary">Submit</button>
       </form>
    </div>
 </div>
 
@endsection
@section('anak2','Upload Photo')
@section('anak3','Halaman Upload Photo')
@section('anak4','Upload Photo')
