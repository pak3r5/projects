<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="{{asset('/plugins/toastr/dist/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/AdminLTE.min.css')}}">
    @yield('extraStyle')
    <!-- Scripts -->
    <script>
        window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token(),]); ?>';
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Proyectos <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">

                        </ul>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" data-keyboard="false" id="newProyect" tabindex="-1" role="dialog" aria-labelledby="newProyectLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar nuevo proyecto</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btnNewProject">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="{{asset('/js/jquery.form.js')}}" type="text/javascript"></script>
<script src="{{asset('/plugins/toastr/dist/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/newProject.js')}}" type="text/javascript"></script>
<script>
    function getMenu(){
        $.get("{{route('home.getMenu')}}", function (data) {
            $menu = $(".dropdown-menu:first");
            $menu.html("");
            $.each(data, function (index, val) {
                $menu.prepend('<li><a href="/projects/' + val.id + '">' + val.name + '</a></li>');
            });
            $menu.append('<li role="separator" class="divider"></li><li class="dropdown-header">No existe el Proyecto?</li><li><a href="#" data-href="{{route('projects.create')}}" data-toggle="modal" data-target="#newProyect" data-title="Agregar nuevo proyecto" class="addProject">Nuevo Proyecto</a></li>');
        }, "json");
    }
    getMenu();
</script>
@yield('extraScript')
</body>
</html>
