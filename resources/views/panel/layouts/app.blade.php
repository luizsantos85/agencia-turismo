<!DOCTYPE html>
<html>

<head>
    <title>{{$title ?? 'Laravel Agência Turismo'}}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!--Fonts-->
    <link rel="stylesheet" href="{{url('assets/panel/css/font-awesome.min.css')}}">

    <!--CSS Person-->
    <link rel="stylesheet" href="{{url('assets/panel/css/especializati.css')}}">
    <link rel="stylesheet" href="{{url('assets/panel/css/especializati-reset.css')}}">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="{{url('assets/panel/imgs/favicon.png')}}">
</head>

<body>

    <section class="menu">

        <div class="logo">
            <img src="{{url('assets/panel/imgs/icone-especializati.png')}}" alt="EspecializaTi" class="logo-painel">
        </div>

        <div class="list-menu">
            <ul class="menu-list">
                <li>
                    <a href="{{route('panel.index')}}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{route('brands.index')}}">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        Marcas
                    </a>
                </li>
                <li>
                    <a href="{{route('planes.index')}}">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        Aviões
                    </a>
                </li>
                <li>
                    <a href="{{route('states.index')}}">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        Estados
                    </a>
                </li>
                <li>
                    <a href="{{route('flights.index')}}">
                        <i class="fa fa-fighter-jet" aria-hidden="true"></i>
                        Voos
                    </a>
                </li>
                <li>
                    <a href="{{route('reserves.index')}}">
                        <i class="fa fa-calendar"></i>
                        Reservas
                    </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="fa fa-user"></i>
                        Usuários
                    </a>
                </li>

            </ul>
        </div>

    </section>
    <!--End Menu-->

    <section class="content">
        <div class="top-dashboard">

            <div class="dropdown user-dash">
                <div class="dropdown-toggle" id="dropDownCuston" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">
                    <img src="{{url('assets/panel/imgs/user-carlos-ferreira.png')}}" alt="Carlos Ferreira"
                        class="user-dashboard img-circle">
                    <p class="user-name">Nome User</p>
                    <span class="caret"></span>
                </div>
                <ul class="dropdown-menu dp-menu" aria-labelledby="dropDownCuston">
                    <li><a href="#">Perfil</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
        <!--Top Dashboard-->

        <div class="content-ds">

            @yield('content')


        </div>
        <!--End Content DS-->

    </section>
    <!--End Content-->



    <!--jQuery-->
    <script src="{{url('assets/panel/js/jquery-3.1.1.min.js')}}"></script>

    <!-- jS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>