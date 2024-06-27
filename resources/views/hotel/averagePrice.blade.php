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
    <h2>Report Average</h2>
    <p>Report of currently avarage price for each hotel</p>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>avg_price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{$d -> type}}</td>
                    <td>{{$d -> name}}</td>
                    <td>{{$d -> avg_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    
</body>
</html>