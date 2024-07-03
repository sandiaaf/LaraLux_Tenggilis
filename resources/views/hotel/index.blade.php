@extends('layout.conquer2')
@section('anak')
@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>  
@endif

<table class="table table-dark table-hover">
    <div>
        @can('permission-owner',Auth::user())
            a href="{{route('hotel.create')}}" class="btn btn-primary">Add Hotel</a>
        @endcan
    </div>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Logo</th>
            <th>Photo</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Tipe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataku as $hotel)
            <tr>
                <td>{{$hotel -> name}}</td>
                <td>
                    <img height='100px' src="{{ asset('/logo/'.$hotel->id.'.jpg')}}"/><br>
                    <a href="{{ url('hotel/uploadLogo/'.$hotel->id) }}">
                    <button class='btn btn-xs btn-default'>upload</button></a>
                </td>
                <td>
                    <img height='100px' src="{{ asset('/images/'.$hotel->image)}}"/><br>
                    <a href="{{ url('hotel/uploadPhoto/'.$hotel->id) }}">
                    <button class='btn btn-xs btn-default'>upload</button></a>
                </td>
                <td>{{$hotel -> address}}</td>
                <td>{{$hotel -> city}}</td>
                <td>{{$hotel -> type}}</td>
                <td>
                    @can('permission-ownerstaff',Auth::user())
                        <a href="{{route('hotel.edit',$hotel -> id)}}" class="btn btn-success">Edit</a>
                    @endcan

                    <form method="POST" action="{{route('hotel.destroy',$hotel->id)}}">
                        @csrf
                        @method('DELETE')
                        @can('permission-owner',Auth::user())
                            <input type="submit" onclick="return confirm('Are you want to delete this?')" value="Delete" class="btn btn-danger">
                        @endcan
                    </form>
                </td>
            </tr>
            @if($hotel->products)
            <tr><td><b>Product:<b> </td></tr>
                @foreach($hotel->products as $product)
                    <tr>
                        <td colspan="1">
                            {{$product->name}}    
                        </td>
                        <td>
                            {{$product->price}}
                        </td>
                        <td>
                            @can('permission-ownerstaff',Auth::user())
                                <a href="{{route('product.edit',$product-> id)}}" class="btn btn-success">Edit Product</a>
                            @endcan
                        </td>
                        <td>
                            <form method="POST" action="{{route('product.destroy',$product->id)}}">
                                @csrf
                                @method('DELETE')
                                @can('permission-owner',Auth::user())
                                    <input type="submit" onclick="return confirm('Are you want to delete this?')" value="Delete Product" class="btn btn-danger">
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
<!-- <div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach($dataku as $hotel)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$hotel -> name}}</h5>
                    <p class="card-text">{{$hotel -> address}}</p>
                    <p class="card-text">{{$hotel -> city}}</p>
                    <p class="card-text">{{$hotel -> type}}</p>

                    <h5 class="card-title">Products: </h5>
                    <ul class="list-group list-group-flush">
                        @foreach($hotel->products as $product)
                        <li class="list-group-item">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <img src="{{asset('images/'.$product->image)}}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <p class="card-text">Rp. {{$product->price}}</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                                </div>
                            </div>
                        </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div> -->
@endsection
@section('anak2','Daftar Hotel')
@section('anak3','Halaman Daftar Hotel')
@section('anak4','Dashboard')
