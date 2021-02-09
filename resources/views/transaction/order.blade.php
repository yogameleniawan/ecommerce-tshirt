<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kaos | Order</title>
    <link rel="icon" href="img/icon/kaos-icon.png" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ url('css/mdb.min.css') }}">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

</head>
<style>
    html,
    body,
    header,
    .view {
        height: 100%;
    }

    body {
        overflow-x: hidden;
    }

</style>

<body style="background-color: #292929;">

    <!-- Start your project here-->
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="navbar-brand" href="/home"><img src="/img/icon/kaos.png" alt="" style="width:130px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
            aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="/home">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/shop">Shop</a>
                </li>
            </ul>
            @if(empty(Auth::user()))
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login/Register</a>
                </li>
            </ul>
            @endif
            @if(!empty(Auth::user()))
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a href="/cart" class="nav-link waves-effect waves-light">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge badge-danger badge-counter">
                            {{$cart}}
                        </span>
                    </a>
                </li>
                <li class="nav-item avatar dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{url('storage')}}/{{Auth::user()->image_profile}}" class="rounded-circle z-depth-0"
                            alt="avatar image" style="width:30px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
                        aria-labelledby="navbarDropdownMenuLink-55">
                        @if(Auth::user()->roles == 'admin')
                        <a class="dropdown-item" href="/manage">Admin Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="/user/profile">Account Info</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                    </div>
                </li>
            </ul>
            @endif
        </div>
    </nav>
    <div class="row" style="padding-left: 50px;padding-right:50px;padding-top:60px">
        <div class="col-md-6">

            <div class="text-center border border-light p-5" style="background-color:white">
                <!-- Card image -->
                <img src="{{url('storage')}}/{{$data->image}}" alt="" style="width:300px;">

                <!-- Card content -->
                <div class="card-body">

                    <!-- Title -->
                    <h4 class="card-title"><b>{{$data->name}}</b></h4>
                    <h4 class="card-title">Qty Available : {{$data->qty}} pcs</h4>
                    <h4 class="card-title">Rp. {{$data->price}}</h4>
                    <!-- Text -->
                    <p>Color : {{$data->color}}</p>
                    <table align="center" style="margin-bottom:10px">
                        <tr>
                            <td style="padding-right: 20px;">
                                <p class="card-text">
                                    <b>Material :</b>
                                    <br>
                                    - Suede fabric<br>
                                    - Despo furing <br>
                                    - Ykk Zipper <br>
                                    - Casmilon Rib <br>
                                    - Inside Pocket <br>
                                </p>
                            </td>
                            <td>
                                <p class="card-text">
                                    <b>Panjang x Lebar dada (cm) :</b>
                                    <br>
                                    S = 62 x 50<br>
                                    M = 65 x 53 <br>
                                    L = 67 x 56<br>
                                    XL = 70 x 59<br>
                                    XXL = 73 x 62 <br>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Card -->
            <div class="card">



            </div>
            <!-- Card -->
        </div>
        <div class="col-md-6">
            @if ($errors->any())
            <div class="alert alert-success">
                <p>{{$errors->first()}}</p>
            </div>
            @endif
            <form class="text-center border border-light p-5" action="{{ route('home.store') }}" method="POST"
                enctype="multipart/form-data" style="background-color:white">
                @csrf
                <input type="hidden" name="iduser" value="{{Auth::user()->id}}">
                <input type="hidden" name="nameitem" value="{{$data->name}}">
                <input type="hidden" name="iditem" value="{{$data->id}}">
                <input type="hidden" name="price" value="{{$data->price}}">
                <!-- Name -->
                <h4 style="padding-bottom: 30px;"><b>Shoping Cart</b></h4>
                <label for="buyer">Buyer's Name</label>
                <input type="text" name="buyer" id="buyer"
                    class="form-control mb-4 @error('buyer') is-invalid @enderror" required autocomplete="buyer"
                    autofocus>
                @error('buyer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!-- Address -->
                <label for="address">Address</label>
                <input type="text" name="address" id="address"
                    class="form-control mb-4 @error('address') is-invalid @enderror" required autocomplete="address"
                    autofocus>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!-- Phone -->
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone"
                    class="form-control mb-4 @error('phone') is-invalid @enderror" required autocomplete="phone"
                    autofocus>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!-- Size -->
                <label>Size</label>
                <select class="browser-default custom-select" name="size">
                    <option disabled selected>Choose Size</option>
                    <option name="s" value="S">S</option>
                    <option name="m" value="M">M</option>
                    <option name="l" value="L">L</option>
                    <option name="xl" value="XL">XL</option>
                    <option name="xxl" value="XXL">XXL</option>
                </select>
                <label for="qty" style="padding-top:25px">Qty</label>
                <input type="number" name="qty" id="qty" class="form-control mb-4 @error('qty') is-invalid @enderror"
                    required autocomplete="qty" autofocus>
                @error('qty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!-- Send button -->
                <button class="btn btn-dark btn-block" type="submit">Add to Cart</button>
                <p style="padding-bottom: 0px;"></p>
            </form>
        </div>
    </div>

    <!--/.Navbar -->
    <!-- End your project here-->

    <!-- jQuery -->
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ url('js/mdb.min.js') }}"></script>
    <!-- Your custom scripts (optional) -->


</body>

</html>
