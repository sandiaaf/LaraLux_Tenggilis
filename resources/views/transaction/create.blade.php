@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Submission</h2>
    <p>Create Transaction</p>

    <form method="POST" action="{{route('transaction.store')}}">
        @csrf
            <div class="form-group">
                <label for="customerIDInput">Customer</label>
                <select name="customerID" class="form-control">
                    @foreach($customers as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="userIDInput">User</label>
                <select name="userID" class="form-control">
                    @foreach($users as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="transactionDateInput">Transaction Date</label>
                <input name="transactionDate" type="date" class="form-control" id="transactionDateInput" aria-describedby="transactionDateHelp" placeholder="Enter Transaction Date">
                <small id="transactionDateHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Create Transaction')
@section('anak3','Halaman Daftar Create Transaction')
@section('anak4','Create Transaction')
