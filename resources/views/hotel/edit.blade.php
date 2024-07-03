@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Update Hotel</h2>
    <p>Update hotel</p>

    <form method="POST" action="{{route('hotel.update',$data->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                <label for="ratingInput">Rating</label>
                <input name="rating" type="rating" class="form-control" id="ratingInput" aria-describedby="ratingHelp" placeholder="Enter Rating">
                <small id="ratingHelp" class="form-text text-muted">Tidak boleh kosong.</small>
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
                        <option 
                            @if ($t->id==$data->type_id)
                                selected
                            @endif
                            value="{{$t ->id}}">{{$t->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Edit Hotel')
@section('anak3','Halaman Edit Hotel')
@section('anak4','Edit Hotel')
