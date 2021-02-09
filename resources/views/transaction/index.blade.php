<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kaos | Home</title>
    <link rel="icon" href="img/icon/kaos-icon.png" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    .intro-2 {
        background-size: cover;
    }

    .navbar {
        background-color: black;
    }

    .top-nav-collapse {
        background-color: black;
    }




    html,
    header,
    .view {
        height: 100%;
    }


    .gambar {
        width: 100%;
        height: 175px;
        padding: 0.9rem 0.9rem
    }

    @media only screen and (max-width: 600px) {
        .gambar {
            width: 100%;
            height: 100%;
            padding: 0.9rem 0.9rem
        }
    }
</style>


<!-- Start your project here-->
<!--Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar animated fadeInDown ">
    <a class="navbar-brand" href="/home"><img src="/img/icon/kaos.png" alt="" style="width:130px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/home">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/shop">Shop</a>
            </li>
            <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown
          </a>
          <div class="dropdown-menu dropdown-secondary animated slideInDown" aria-labelledby="navbarDropdownMenuLink-555">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> -->
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
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{url('storage')}}/{{Auth::user()->image_profile}}" class="rounded-circle z-depth-0" alt="avatar image" style="width:30px;">
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
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
</head>

<body style="background-color: #292929;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding-top: 10%;">

                    <div class="card-body">
                        @if(Session::has('success'))
                        @include('layouts.flash-success',[ 'message'=> Session('success') ])
                        @endif
                        <div class="row">
                            @foreach ($data as $d)
                            <div class="col-sm-3">
                                <div class="card mb-3">
                                    <div class="view overlay">
                                        <img style="align-content: center" class="card-img-top gambar" src="{{url('storage')}}/{{$d->image}}" alt="Card image cap">
                                        <a href="{{url('storage')}}/{{$d->image}}" target="_blank">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold" style="text-transform: capitalize;font-size:15px">
                                            {{ Str::words($d->name,6) }}</h5>
                                        <p class="card-text text-center">Rp. {{ number_format($d->price,2,',','.') }}
                                        </p>
                                        <p class="card-text text-center">Qty Available : {{ $d->qty }}
                                        </p>
                                        @if($d->qty > 0)
                                        <a href="/shop/{{$d->id}}/order" class="btn btn-black btn-block btn-sm">BELI</a>
                                        @else
                                        <p class="btn btn-block btn-sm" style="background-color: #616161;color:white">OUT OF STOCK</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
<!-- jQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript"></script>

</body>



</html>
