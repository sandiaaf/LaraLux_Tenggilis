@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Add Customer</h2>
    <p>Add Customer</p>

    <form method="POST" action="{{route('customer.store')}}">
        @csrf
            <div class="form-group">
            <label for="customerInput">Customer Name</label>
            <input name="customerName" type="text" class="form-control" id="customerInput" aria-describedby="customerHelp" placeholder="Enter Customer Name">
            <small id="customerHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="typeInput">Address</label>
                <input name="address" type="text" class="form-control" id="addressInput" aria-describedby="addressHelp" placeholder="Enter Address">
                <small id="addressHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>

            <div class="form-group">
                <label for="userIDInput">User</label>
                <select name="userID" class="form-control">
                    @foreach($users as $u)
                        <option value="{{$u ->id}}">{{$u->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Add Customer')
@section('anak3','Halaman Add Customer')
@section('anak4','Add Customer')
