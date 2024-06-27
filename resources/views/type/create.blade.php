@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Submission</h2>
    <p>Create type hotel</p>

    <form method="POST" action="{{route('type.store')}}">
        @csrf
            <div class="form-group">
            <label for="typeInput">Type Name</label>
            <input name="typeName" type="text" class="form-control" id="typeInput" aria-describedby="typeHelp" placeholder="Enter Type Name">
            <small id="typeHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Create Type')
@section('anak3','Halaman Daftar Create Type')
@section('anak4','Create Type')
