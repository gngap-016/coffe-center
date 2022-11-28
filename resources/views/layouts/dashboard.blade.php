<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Coffee App</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900" rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('app-assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app-assets/js/bootstrap2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app-assets/js/feather.min.js') }}"></script>

    <style>
        body {
            font-family: 'Poppins';
        }

        .sidebar .nav-link.active,.sidebar .nav-link.active:hover  {
            color: white;
            background: #DFD3C3;
            margin: 10px !important;
            border-radius: 5px !important;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: grey;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg sticky-top" style="min-height: 76px; background-color: #F8EDE3;">
            <div class="container">
              <a class="navbar-brand fw-bold" href="/">Coffee App</a>
            </div>
          </nav>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #7E6F83">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            @foreach (config('menu') as $key => $value)
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-2 {{ activeMenu($value['route']) }}" aria-current="page" href="{{ route($value['route']) }}">
                                        <i data-feather="{{ $value['icon'] }}" class="align-text-bottom my-auto me-2 text-light"></i>
                                        <span style="padding-top:3px !important" class="p-0 my-auto text-light">{{ $value['name'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="nav-link py-2 d-flex" aria-current="page"href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out" class="align-text-bottom my-auto me-2 text-light"></i>
                                    <span style="padding-top:3px !important" class="p-0 my-auto text-light">Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3" style="min-height: 100vh">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap-notify.min.js') }}" ></script>
    <script src="{{ asset('app-assets/js/notify-script.js') }}" ></script>
    <script src="{{ asset('app-assets/js/helper.js') }}" ></script>
    <script src="{{ asset('app-assets/js/sweet-alert/sweetalert2@11.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('layouts.includes.notify')

    @yield('script')
</body>
</html>
