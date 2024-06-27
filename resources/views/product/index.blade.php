@extends('layout.conquer2')
@section('anak')
@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>  
@endif

<table class="table table-dark table-hover">
    <div>
        <a href="{{route('product.create')}}" class="btn btn-success">Add</a>
        <a href="#modalCreate" data-toggle="modal" class="btn btn-primary">Add (With Modals)</a>
        <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Add New Product</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('product.store')}}">
                        @csrf
                            <div class="form-group">
                            <label for="productInput">Product Name</label>
                            <input name="productName" type="text" class="form-control" id="productInput" aria-describedby="productHelp" placeholder="Enter Product Name">
                            <small id="productHelp" class="form-text text-muted">Tidak boleh kosong.</small>
                            </div>
                
                            <div class="form-group">
                                <label for="typeRoomInput">Type Room</label>
                                <input name="typeRoom" type="text" class="form-control" id="typeRoomInput" aria-describedby="typeRoomHelp" placeholder="Enter Type Room">
                                <small id="typeRoomHelp" class="form-text text-muted">Tidak boleh kosong.</small>
                            </div>
                
                            <div class="form-group">
                                <label for="hotelIDInput">Hotel</label>
                                <select name="hotelID" class="form-control">
                                    @foreach($hotels as $h)
                                        <option value="{{$h ->id}}">{{$h->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="priceInput">Price</label>
                                <input name="price" type="number" class="form-control" id="priceInput" aria-describedby="priceHelp" placeholder="Enter Price">
                                <small id="priceHelp" class="form-text text-muted">Tidak boleh kosong.</small>
                            </div>
                            <div class="form-group">
                                <label for="imageInput">Image</label>
                                <input name="image" type="text" class="form-control" id="imageInput" aria-describedby="imageHelp" placeholder="Enter Image">
                                <small id="imageHelp" class="form-text text-muted">Tidak boleh kosong. Contoh: "image.png"</small>
                            </div>
                            <div class="form-group">
                                <label for="availableRoomInput">Available Room</label>
                                <input name="availableRoom" type="number" class="form-control" id="availableRoomInput" aria-describedby="availableRoomHelp" placeholder="Enter Available Room">
                                <small id="avalableRoomHelp" class="form-text text-muted">Tidak boleh kosong.</small>
                            </div>
                

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <thead>
        <tr>
            <th>Name</th>
            <th>Images</th>
            <th>Type Room</th>
            <th>Created at</th>
            <th>Update at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
            <tr id="tr_{{$p->id}}">
                <td>{{$p -> name}}</td>
                <td>
                    @if($p->filenames)
                       @foreach ($p->filenames as $filename)
                            <img src="{{asset('productImages/'.$p->id.'/'.$filename)}}"/><br>

                            <form style="display: inline" method="POST"
                                action="{{url('product/delPhoto')}}">
                                @csrf
                            <input type="hidden" value="{{'productImages/'.$p->id.'/'.$filename}}" name='filepath' />
                            <input type="submit" value="delete" class="btn btn-danger btn-xs"
                            onclick="return confirm('Are you sure ? ');">
                            </form>
                       @endforeach
                    @endif
                    <a href="{{ url('product/uploadPhoto/'.$p->id) }}">
                       <button class='btn btn-xs btn-default'>upload</button></a>
                    
                </td>
                 
                <td>{{$p -> type_room}}</td>
                <td>{{$p -> created_at}}</td>
                <td>{{$p -> updated_at}}</td>
                <td>
                    <a href="{{route('product.edit',$p -> id)}}" class="btn btn-success">Edit</a>
                    
                    <a href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$p->id}})" class="btn btn-success">Edit Product Modal</a>
                    <a href="#" value="DeleteNoReload" class="btn btn-danger"
                    onclick="if(confirm('Are you sure to delete {{$p->id}}-{{$p->name}}?')) deleteDataRemoveTR({{$p->id}})">Delete No Reload</a>

                    <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog modal-wide">
                            <div class="modal-content">
                                <div class="modal-body" id="modalContent">

                                </div>

                            </div>
                        </div>

                    </div>
                    
                    <form method="POST" action="{{route('product.destroy',$p->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" onclick="return confirm('Are you want to delete this?')" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
@section('anak2','Daftar Product')
@section('anak3','Halaman Daftar Product')
@section('anak4','Product')
@section('js')
<script>
    function getEditForm(product_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("product.getEditForm")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': product_id
            },
            success: function (data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(product_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("product.deleteData")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': product_id
            },
            success: function (data) {
                if(data.status == "oke"){
                    $('#tr_'+product_id).remove();
                }
            }
        });
    }
</script>
@endsection
