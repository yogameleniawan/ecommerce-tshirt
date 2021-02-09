<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kaos | Account</title>
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
    <!-- Custom styles for this template -->
    <link href="{{ url('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a href="/carts" class="nav-link waves-effect waves-light">
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
                        <a class="dropdown-item" href="#">Account Info</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                    </div>
                </li>
            </ul>
            @endif
        </div>
    </nav>

    <!-- Begin Page Content -->
    <div class="container" style="padding-top: 50px;">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark" style="padding-bottom:20px">Account</h6>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <!-- Default form contact -->
            <form class="text-center border border-light p-5" action="{{ route('user.update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <label for="defaultContactFormName">Name</label>
                <input type="text" name="name" id="defaultContactFormName" class="form-control mb-4" value="{{Auth::user()->name}}">

                <!-- Email -->
                <label for="defaultContactFormEmail">Email</label>
                <input type="email" name="email" id="defaultContactFormEmail" class="form-control mb-4" value="{{Auth::user()->email}}">

                <!-- Password -->
                <label for="defaultContactFormPassword">Password</label>
                <input type="password" name="password" id="defaultContactFormPassword" class="form-control mb-4" placeholder="*******">

                <label>Profile Image</label>
                <br>
                <img src="{{url('storage')}}/{{Auth::user()->image_profile}}" style="width:20%">
                <input type="file" name="image" id="defaultContactFormImage" class="form-control mb-4">

                <!-- Send button -->
                <button class="btn btn-dark btn-block" type="submit">Update</button>

            </form>
            <!-- Default form contact -->

        </div>
        <!-- /.container-fluid -->

    </div>
    </div>

    <!--/.Navbar -->
    <!-- End your project here-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ url('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('assets/admin/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
