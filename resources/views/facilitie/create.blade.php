@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Add Facilitie</h2>
    <p>Add Facilitie</p>

    <form method="POST" action="{{route('facilitie.store')}}">
        @csrf
            <div class="form-group">
            <label for="nameInput">Facilitie Name</label>
            <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp" placeholder="Enter Facilitie Name">
            <small id="nameHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="descInput">Facilitie Description</label>
                <input name="desc" type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Description">
                <small id="descHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="productIDInput">Product</label>
                <select name="productID" class="form-control">
                    @foreach($products as $p)
                        <option value="{{$p ->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Add Facilitie')
@section('anak3','Halaman Add Facilitie')
@section('anak4','Add Facilitie')
