@extends('layout.conquer2')
@section('anak')
@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>  
@endif

<table class="table table-dark table-hover">
    <div>
        {{-- <a href="{{route('customer.create')}}" class="btn btn-success">Add</a> --}}

        @can('permission-owner',Auth::user())
            <a href="#modalCreate" data-toggle="modal" class="btn btn-primary">Add</a>
        @endcan

        <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Add New Facilitie</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('facilitie.store')}}">
                        @csrf
                            <div class="form-group">
                            <label for="nameInput">Facilitie Name</label>
                            <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp" placeholder="Enter Facilitie Name">
                            <small id="nameHelp" class="form-text text-muted">Tidak boleh kosong.</small>
                            </div>
                
                            <div class="form-group">
                                <label for="descInput">Facilitie Description</label>
                                <input name="desc" type="text" class="form-control" id="descInput" aria-describedby="descHelp" placeholder="Enter Facilitie Description">
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
            <th>Description</th>
            <th>Product</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facilities as $f)
            <tr id="tr_{{$f->id}}">
                <td>{{$f -> name}}</td>
                <td>{{$f -> description}}</td>
                <td>{{$f -> product->name}}</td>
                <td>
                    {{-- <a href="{{route('customer.edit',$c -> id)}}" class="btn btn-success">Edit</a> --}}

                    @can('delete-permission',Auth::user())
                    <a href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$f->id}})" class="btn btn-success">Edit Facilitie</a>
                    <a href="#" value="DeleteNoReload" class="btn btn-danger"
                    onclick="if(confirm('Are you sure to delete {{$f->id}}-{{$f->name}}?')) deleteDataRemoveTR({{$f->id}})">Delete</a>
                    @endcan
                    <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog modal-wide">
                            <div class="modal-content">
                                <div class="modal-body" id="modalContent">

                                </div>

                            </div>
                        </div>
                    </div>
                    
                    {{-- <form method="POST" action="{{route('customer.destroy',$c->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" onclick="return confirm('Are you want to delete this?')" value="Delete" class="btn btn-danger">
                    </form> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
@section('anak2','Daftar Facilitie')
@section('anak3','Halaman Daftar Facilitie')
@section('anak4','Facilitie')
@section('js')
<script>
    function getEditForm(f_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("facilitie.getEditForm")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': f_id
            },
            success: function (data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(f_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("facilitie.deleteData")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': f_id
            },
            success: function (data) {
                if(data.status == "oke"){
                    $('#tr_'+f_id).remove();
                }
            }
        });
    }
</script>
@endsection
