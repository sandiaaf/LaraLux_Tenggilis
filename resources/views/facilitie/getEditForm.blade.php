<form method="POST" action="{{route('facilitie.update',$data->id)}}">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="name">Facilitie Name</label>
            <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp" value="{{$data->name}}" placeholder="Enter Facilitie Name">
            <small id="nameHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <div class="form-group">
            <label for="descInput">Description</label>
            <input name="desc" type="text" class="form-control" id="descInput" aria-describedby="descHelp" value="{{$data->description}}" placeholder="Enter Facilitie Description">
            <small id="descHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>