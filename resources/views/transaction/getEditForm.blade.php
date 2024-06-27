<form method="POST" action="{{route('transaction.update',$data->id)}}">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="customerIDInput">Customer</label>
            <select name="customerID" class="form-control">
                @foreach($customers as $c)
                    <option 
                        @if ($c->id==$data->customer_id)
                            selected
                        @endif
                        value="{{$c->id}}">{{$c->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="userIDInput">User</label>
            <select name="userID" class="form-control">
                @foreach($users as $u)
                    <option 
                        @if ($u->id==$data->user_id)
                            selected
                        @endif
                        value="{{$u->id}}">{{$u->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>