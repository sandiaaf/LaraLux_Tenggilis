<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHotelBookingApps</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  @if (isset($hotels))
    <div class="container p-5">
      @if($kategori=='single')
        <h1 class="mb-5 text-center">Single</h1>
        <div class="row justify-content-center grid gap-3">
            @foreach($hotels as $hotel)
                <div class="card p-2" style="width: 18rem;">
                  <img class="card-img-top rounded" style="height:200px; object-fit: cover;" src="{{ $hotel['image'] }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">{{ $hotel['name'] }}</h5>
                    <p class="card-text">{{ $hotel['desc'] }}</p>
                    <a href="#" class="btn btn-primary">Booking</a>
                  </div>
                </div>
            @endforeach
        </div>

      @elseif($kategori=='standard-double')
        <h1 class="mb-5 text-center">Standard Double</h1>
        <div class="row justify-content-center grid gap-3">
            @foreach($hotels as $hotel)
                <div class="card p-2" style="width: 18rem;">
                  <img class="card-img-top rounded" style="height:200px; object-fit: cover;" src="{{ $hotel['image'] }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">{{ $hotel['name'] }}</h5>
                    <p class="card-text">{{ $hotel['desc'] }}</p>
                    <a href="#" class="btn btn-primary">Booking</a>
                  </div>
                </div>
            @endforeach
        </div>
      @endif
    </div>

  @elseif (isset($kategoris))
    <div class="container text-center p-5">
      <h1 class="mb-5 text-center">Kategori Hotel</h1>
      <div class="row justify-content-center grid gap-3">
          @foreach($kategoris as $ktg)
              <div class="card p-2" style="width: 18rem;">
                <img class="card-img-top rounded" style="height:200px; object-fit: cover;" src="{{ $ktg['image'] }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{ $ktg['name'] }}</h5>
                  <!-- <p class="card-text"></p> -->
                  <a href="{{ url($ktg['url']) }}" class="btn btn-primary">Check</a>
                </div>
              </div>
          @endforeach
      </div>
    </div>

  @else
    <div class="container text-center d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div>
        <h1 class="p-3">Selamat datang di MyHotelBookingApps</h1>
        <a class="btn btn-outline-primary btn-lg" href="{{ url('/kategori') }}">Kategori</a>
        <a class="btn btn-primary btn-lg" href="{{ url('/promo') }}">Promo</a>
        @if (isset($name))
          <h1 class="p-3">Deskripsi Hotel {{$name}}</h1>
        @endif
      </div>
    </div>

    
  @endif

</body>
</html>