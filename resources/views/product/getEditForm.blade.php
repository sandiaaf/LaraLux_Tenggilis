<form method="POST" action="{{route('product.update',$data->id)}}">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="productInput">Product Name</label>
            <input name="productName" type="text" class="form-control" id="productInput" aria-describedby="productHelp" value="{{$data->name}}" placeholder="Enter Product Name">
            <small id="productHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <div class="form-group">
            <label for="typeRoomInput">Type Room</label>
            <input name="typeRoom" type="text" class="form-control" id="typeRoomInput" aria-describedby="typeRoomHelp" value="{{$data->type_room}}" placeholder="Enter Type Room">
            <small id="typeRoomHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <div class="form-group">
            <label for="hotelIDInput">Hotel</label>
            <select name="hotelID" class="form-control">
                @foreach($hotels as $h)
                    <option 
                        @if ($h->id==$data->hotel_id)
                            selected
                        @endif
                        value="{{$h->id}}">{{$h->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="priceInput">Price</label>
            <input name="price" type="number" class="form-control" id="priceInput" aria-describedby="priceHelp" value="{{$data->price}}" placeholder="Enter Price">
            <small id="priceHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <div class="form-group">
            <label for="imageInput">Image</label>
            <input name="image" type="text" class="form-control" id="imageInput" aria-describedby="imageHelp" value="{{$data->image}}" placeholder="Enter Image">
            <small id="imageHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <div class="form-group">
            <label for="availableInput">Available Room</label>
            <input name="availableRoom" type="number" class="form-control" id="availableInput" aria-describedby="availableHelp" value="{{$data->available_room}}" placeholder="Enter Available Room">
            <small id="availableHelp" class="form-text text-muted">Tidak boleh kosong.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>