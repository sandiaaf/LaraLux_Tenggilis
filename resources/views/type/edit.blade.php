@extends('layout.conquer2')
@section('anak')

<div class="m-3">
    <h2>Edit Submission</h2>
    <p>Edit type hotel</p>

    <form method="POST" action="{{route('type.update',$data->id)}}">
        @csrf
        @method('PUT')
            <div class="form-group">
            <label for="typeInput">Type Name</label>
            <input name="typeName" type="text" class="form-control" id="typeInput" aria-describedby="typeHelp" value="{{$data->name}}" placeholder="Enter Type Name">
            <small id="typeHelp" class="form-text text-muted">Tidak boleh kosong.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection
@section('anak2','Edit Type')
@section('anak3','Halaman Daftar Edit Type')
@section('anak4','Edit Type')
