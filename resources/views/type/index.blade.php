@extends('layout.conquer2')
@section('anak')
@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>  
@endif

<table class="table table-dark table-hover">
    <div>
        @can('permission-owner', Auth::user())
            <!-- <a href="{{route('type.create')}}" class="btn btn-success">Add Type</a> -->
            <a href="#modalCreate" data-toggle="modal" class="btn btn-primary">Add Type(With Modals)</a>
        @endcan
        <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Add New Type</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('type.store')}}">
                        @csrf
                            <div class="form-group">
                            <label for="typeInput">Type Name</label>
                            <input name="typeName" type="text" class="form-control" id="typeInput" aria-describedby="typeHelp" placeholder="Enter Type Name">
                            <small id="typeHelp" class="form-text text-muted">Tidak boleh kosong.</small>
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
            <th>Nama</th>
            <th>Created at</th>
            <th>Update at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataku as $type)
            <tr id="tr_{{$type->id}}">
                <td>{{$type -> name}}</td>
                <td>{{$type -> created_at}}</td>
                <td>{{$type -> updated_at}}</td>
                <td>
                    <a href="{{route('type.edit',$type -> id)}}" class="btn btn-success">Edit Type</a>
                    <a href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$type->id}})" class="btn btn-success">Edit Type Modal</a>

                    @can('permission-owner',Auth::user())
                    <a href="#" value="DeleteNoReload" class="btn btn-danger"
                    onclick="if(confirm('Are you sure to delete {{$type->id}}-{{$type->name}}?')) deleteDataRemoveTR({{$type->id}})">Delete No Reload</a>
                    @endcan

                    <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog modal-wide">
                            <div class="modal-content">
                                <div class="modal-body" id="modalContent">

                                </div>

                            </div>
                        </div>

                    </div>
                    
                    @can('permission-owner',Auth::user())
                    <form method="POST" action="{{route('type.destroy',$type->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" onclick="return confirm('Are you want to delete this?')" value="Delete" class="btn btn-danger">
                    </form>
                    @endcan

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
@section('anak2','Daftar Tipe')
@section('anak3','Halaman Daftar Tipe')
@section('anak4','Type')
@section('js')
<script>
    function getEditForm(type_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("type.getEditForm")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': type_id
            },
            success: function (data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(type_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("type.deleteData")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': type_id
            },
            success: function (data) {
                if(data.status == "oke"){
                    $('#tr_'+type_id).remove();
                }
            }
        });
    }
</script>
@endsection

