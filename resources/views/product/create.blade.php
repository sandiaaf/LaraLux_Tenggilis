@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Add Product</h2>
    <p>Add Product</p>

    <form method="POST" action="{{route('product.store')}}">
        @csrf
            <div class="form-group">
            <label for="productInput">Product Name</label>
            <input name="productName" type="text" class="form-control" id="productInput" aria-describedby="productHelp" placeholder="Enter Product Name">
            <small id="productHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="typeRoomInput">Type Room</label>
                <input name="typeRoom" type="text" class="form-control" id="typeRoomInput" aria-describedby="typeRoomHelp" placeholder="Enter Type Room">
                <small id="typeRoomHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="hotelIDInput">Hotel</label>
                <select name="hotelID" class="form-control">
                    @foreach($hotels as $h)
                        <option value="{{$h ->id}}">{{$h->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="priceInput">Price</label>
                <input name="price" type="number" class="form-control" id="priceInput" aria-describedby="priceHelp" placeholder="Enter Price">
                <small id="priceHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <div class="form-group">
                <label for="imageInput">Image</label>
                <input name="image" type="text" class="form-control" id="imageInput" aria-describedby="imageHelp" placeholder="Enter Image">
                <small id="imageHelp" class="form-text text-muted">Tidak boleh kosong. Contoh: "image.png"</small>
            </div>
            <div class="form-group">
                <label for="availableRoomInput">Available Room</label>
                <input name="availableRoom" type="number" class="form-control" id="availableRoomInput" aria-describedby="availableRoomHelp" placeholder="Enter Available Room">
                <small id="avalableRoomHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</div>


@endsection
@section('anak2','Add Product')
@section('anak3','Halaman Add Product')
@section('anak4','Add Product')
