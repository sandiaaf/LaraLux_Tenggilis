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
                  <h4 class="modal-title">Add New Member</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('customer.store')}}">
                        @csrf
                            <div class="form-group">
                            <label for="customerInput">Member Name</label>
                            <input name="customerName" type="text" class="form-control" id="customerInput" aria-describedby="customerHelp" placeholder="Enter Member Name">
                            <small id="customerHelp" class="form-text text-muted">Tidak boleh kosong.</small>
                            </div>
                
                            <div class="form-group">
                                <label for="addressInput">Address</label>
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
            <th>Address</th>
            <th>Poin</th>
            <th>Created at</th>
            <th>Update at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataku as $c)
            <tr id="tr_{{$c->id}}">
                <td>{{$c -> name}}</td>
                <td>{{$c -> address}}</td>
                <td>{{$c -> poin}}</td>
                <td>{{$c -> created_at}}</td>
                <td>{{$c -> updated_at}}</td>
                <td>
                    {{-- <a href="{{route('customer.edit',$c -> id)}}" class="btn btn-success">Edit</a> --}}

                    @can('permission-owner',Auth::user())
                        <a href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$c->id}})" class="btn btn-success">Edit Member</a>
                        <a href="#" value="DeleteNoReload" class="btn btn-danger"
                        onclick="if(confirm('Are you sure to delete {{$c->id}}-{{$c->name}}?')) deleteDataRemoveTR({{$c->id}})">Delete</a>
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
@section('anak2','Daftar Member')
@section('anak3','Halaman Daftar Member')
@section('anak4','Member')
@section('js')
<script>
    function getEditForm(customer_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("customer.getEditForm")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': customer_id
            },
            success: function (data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(customer_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("customer.deleteData")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': customer_id
            },
            success: function (data) {
                if(data.status == "oke"){
                    $('#tr_'+customer_id).remove();
                }
            }
        });
    }
</script>
@endsection
