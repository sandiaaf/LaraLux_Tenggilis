<form method="POST" action="{{route('customer.update',$data->id)}}">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="customerInput">Customer Name</label>
            <input name="customerName" type="text" class="form-control" id="customerInput" aria-describedby="customerHelp" value="{{$data->name}}" placeholder="Enter Customer Name">
            <small id="customerHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <div class="form-group">
            <label for="addressInput">Address</label>
            <input name="address" type="text" class="form-control" id="addressInput" aria-describedby="addressHelp" value="{{$data->address}}" placeholder="Enter Customer Address">
            <small id="addressHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>