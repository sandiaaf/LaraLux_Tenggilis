@extends('layout.conquer2')
@section('anak')
<div class="m-3">
    <h2>Transaction</h2>
    <p>Report of Transaction</p>
    <table class="table table-dark table-hover">
        <div>
            <!-- <a href="{{route('transaction.create')}}" class="btn btn-success">Add</a> -->

            @can('permission-owner',Auth::user())
            <a href="#modalCreate" data-toggle="modal" class="btn btn-primary">Add</a>
            @endcan

            <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" >
                    <div class="modal-header">
                      <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true"></button>
                      <h4 class="modal-title">Add New Transaction</h4>
                    </div>
                    <div class="modal-body">
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
                <th>ID</th>
                <th>Pembeli</th>
                <th>Kasir</th>
                <th>Tanggal Transaction</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr id="tr_{{$d->id}}">
                    <td>{{$d ->id}}</td>
                    <td>{{$d ->customer->name}}</td>
                    <td>{{$d ->user->name}}</td>
                    <td>{{$d ->created_at}}</td>
                    <td>
                        <a class="btn btn-info"  href="#modalTrans_{{$d->id}}" data-toggle="modal">Lihat Rincian Pembelian</a>
    
                        <div class="modal fade" id="modalTrans_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Transaction {{$d->customer->name}}</h3>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($d->products as $p)
                                            <p>Produk yang di pesan :
                                                {{$p->name}}
                                            </p>
                                            <p>Dari Hotel
                                                {{$p->hotel->name}}
                                            </p>
                                            <p>
                                                Harga Rp.  
                                                {{$p->price}},00 /pcs
                                            </p>
                                            <p>
                                                Dengan Jumlah:
                                                {{$p->pivot->quantity}}
                                            </p>

                                            <h4>Total Rp. {{$p->pivot->subtotal}},00</h4>
                                        @endforeach
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{route('transaction.edit',$d->id)}}" class="btn btn-success">Edit</a>
                        <a href="#modalEditA" data-toggle="modal" onclick="getEditForm({{$d->id}})" class="btn btn-success">Edit Transaction Modal</a>

                        @can('permission-owner',Auth::user())
                            <a href="#" value="DeleteNoReload" class="btn btn-danger"
                            onclick="if(confirm('Are you sure to delete {{$d->id}}-{{$d->customer->name}}?')) deleteDataRemoveTR({{$d->id}})">Delete No Reload</a>
                        @endcan

                        <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog modal-wide">
                                <div class="modal-content">
                                    <div class="modal-body" id="modalContent">

                                    </div>
                                </div>
                            </div>

                        </div>
                    
                        <!-- <form method="POST" action="{{route('transaction.destroy',$d->id)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" onclick="return confirm('Are you want to delete this?')" value="Delete" class="btn btn-danger">
                        </form> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('anak2','Transaction')
@section('anak3','Halaman Transaction')
@section('anak4','Transaction')
@section('js')
<script>
    function getEditForm(transaction_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("transaction.getEditForm")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': transaction_id
            },
            success: function (data) {
                $('#modalContent').html(data.msg)
            }
        });
    }

    function deleteDataRemoveTR(transaction_id)
    {
        $.ajax({
            type: "POST",
            url: "{{route("transaction.deleteData")}}",
            data: {
                '_token' : '<?php echo csrf_token() ?>',
                'id': transaction_id
            },
            success: function (data) {
                if(data.status == "oke"){
                    $('#tr_'+transaction_id).remove();
                }
            }
        });
    }
</script>
@endsection