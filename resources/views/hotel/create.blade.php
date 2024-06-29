@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Add Hotel</h2>
    <p>Add hotel</p>

    <form method="POST" action="{{route('hotel.store')}}">
        @csrf
            <div class="form-group">
            <label for="typeInput">Hotel Name</label>
            <input name="hotelName" type="text" class="form-control" id="hotelInput" aria-describedby="hotelHelp" placeholder="Enter Hotel Name">
            <small id="hotelHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="typeInput">Address</label>
                <input name="address" type="text" class="form-control" id="addressInput" aria-describedby="addressHelp" placeholder="Enter Address">
                <small id="addressHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <div class="form-group">
                <label for="phoneInput">Phone</label>
                <input name="phone" type="text" class="form-control" id="phoneInput" aria-describedby="phoneHelp" placeholder="Enter Phone">
                <small id="phoneHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input name="email" type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter Email">
                <small id="emailHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <div class="form-group">
                <label for="imageInput">Image</label>
                <input name="image" type="file" class="form-control" id="imageInput" aria-describedby="imageHelp" placeholder="Enter Image">
                <small id="imageHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <div class="form-group">
                <label for="typeIDInput">Type</label>
                <select name="typeID" class="form-control">
                    @foreach($types as $t)
                        <option value="{{$t ->id}}">{{$t->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Add Hotel')
@section('anak3','Halaman Add Hotel')
@section('anak4','Add Hotel')
