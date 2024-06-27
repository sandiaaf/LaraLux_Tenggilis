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
                <label for="postCodeInput">Post Code</label>
                <input name="postCode" type="text" class="form-control" id="postCodeInput" aria-describedby="postCodeHelp" placeholder="Enter Post Code">
                <small id="postCodeHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="cityInput">City</label>
                <input name="city" type="text" class="form-control" id="cityInput" aria-describedby="cityHelp" placeholder="Enter City">
                <small id="cityHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="stateInput">State</label>
                <input name="state" type="text" class="form-control" id="stateInput" aria-describedby="stateHelp" placeholder="Enter State">
                <small id="stateHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="currencyInput">Currency</label>
                <input name="currency" type="text" class="form-control" id="currencyInput" aria-describedby="currencyHelp" placeholder="Enter Currency">
                <small id="currencyHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="accomInput">Accommodation Type</label>
                <input name="accom" type="text" class="form-control" id="accomInput" aria-describedby="accomHelp" placeholder="Enter Accomodation Type">
                <small id="accomHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="categoryInput">Category</label>
                <input name="category" type="number" class="form-control" id="categoryInput" aria-describedby="categoryHelp" placeholder="Enter Category">
                <small id="categoryHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="webInput">Web</label>
                <input name="web" type="text" class="form-control" id="webInput" aria-describedby="webHelp" placeholder="Enter Web">
                <small id="webHelp" class="form-text text-muted">Tidak boleh kosong.</small>
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
