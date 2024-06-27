<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="m-3">
    <h2>Product Detail</h2>
    <p>The table class adds basic styling (light padding and only horizontal dividers) to a table</p>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Created At</th>
                <th>Update At</th>
                <th>Hotel ID</th>
                <th>Hotel Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data -> name}}</td>
                <td>{{$data -> price}}</td>
                <td>{{$data -> created_at}}</td>
                <td>{{$data -> updated_at}}</td>
                <td>{{$data -> hotel_id}}</td>
                <td>{{$data -> hotel->name}}</td>
            </tr>
        </tbody>
    </table>

    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{$data -> name}}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{$data -> price}}</h6>
        <p class="card-text">Created at: {{$data -> created_at}}</p>
        <p class="card-text">Updated at: {{$data -> updated_at}}</p>
        <p class="card-text">{{$data -> hotel_id}}</p>
        <p class="card-text">{{$data -> hotel->name}}</p>
    </div>
    </div>
    </div>
    
</body>
</html>