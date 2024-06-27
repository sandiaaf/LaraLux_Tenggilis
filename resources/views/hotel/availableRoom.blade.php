@extends('layout.conquer2')
@section('anak')
<div class="m-3">
<h2>Reporting</h2>
<p>Report of currently available rooms for each hotel</p>
<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th>Hotel ID</th>
            <th>Hotel Name</th>
            <th>Total Available Room(s)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
            <tr>
                <td>{{$d -> id}}</td>
                <td>{{$d -> name}}</td>
                <td>{{$d -> room}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
@section('anak2','Daftar Available Room')
@section('anak3','Halaman Daftar Available Room')
@section('anak4','Available Room')
