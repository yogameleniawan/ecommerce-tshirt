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
    background-color: transparent;
  }

  .top-nav-collapse {
    background-color: #000000;
    opacity: 0.6;
  }

  @media only screen and (max-width: 768px) {
    .navbar {
      background-color: #000000;
      opacity: 0.6;
    }
  }

  html,
  body,
  header,
  .view {
    height: 100%;
  }
</style>

<body>

  <!-- Start your project here-->
  <!--Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar animated fadeInDown ">
    <a class="navbar-brand" href="/home"><img src="/img/icon/kaos.png" alt="" style="width:130px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/home">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
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
  <!--/.Navbar -->

  <!--Carousel Wrapper-->
  <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-2" data-slide-to="1"></li>
      <li data-target="#carousel-example-2" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox" style="position-fixed">
      <div class="carousel-item active">
        <div class="view">
          <img class="d-block w-100 animated slideInDown" src="img/carousel/item1.jpg" alt="First slide">
          <div class="mask rgba-black-light"></div>
        </div>
        <div class="carousel-caption">
          <a href="/shop"><img class="animated fadeInUp delay-1s" src="img/carousel/shop.png" width="20%" height="20%" style="padding-bottom:30px"></a>
          <h3 class="h3-responsive animated fadeInDown">New Brand</h3>
          <p class="animated fadeInUp">Best T-Shirt</p>
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block w-100 animated rotateInUpLeft" src="img/carousel/item2.jpg" alt="Second slide">
          <div class="mask rgba-black-strong"></div>
        </div>
        <div class="carousel-caption">
          <a href="/shop"><img class="animated fadeInUp delay-1s" src="img/carousel/shop.png" width="20%" height="20%" style="padding-bottom:30px"></a>
          <h3 class="h3-responsive animated fadeInLeft">Stylist Brand</h3>
          <p class="animated fadeInRight">Comfortable </p>
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block w-100 animated fadeInUpBig" src="img/carousel/item3.jpg" alt="Third slide">
          <div class="mask rgba-black-slight"></div>
        </div>
        <div class="carousel-caption">
          <a href="/shop"><img class="animated fadeInUp delay-1s" src="img/carousel/shop.png" width="20%" height="20%" style="padding-bottom:30px"></a>
          <h3 class="h3-responsive animated fadeInUp">Popular T-Shirt </h3>
          <p class="animated fadeInDown">Elegant Style</p>
        </div>
      </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->

  <!-- Footer -->
  <footer class="page-footer font-small black" style="padding-top:50px;padding-bottom:50px">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <a href="https://mdbootstrap.com/"> Epic Team</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->

  <!-- End your project here-->

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
<script>
  $(document).ready(function() {
    new WOW().init();
  });
</script>

</html>
