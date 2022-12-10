@php
    $set = \App\Models\Setting::first();
    $user = \App\Models\User::first();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon"
        href="{{ $set->logo == null ? asset('app-assets/icon/store.png') : asset('storage/setting_images') . $set->logo }}">
    <title>{{ $set->name }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900"
        rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript" src="{{ asset('app-assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app-assets/js/bootstrap2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app-assets/js/feather.min.js') }}"></script>

    <style>
        body {
            font-family: 'Poppins';
        }

        footer a {
            color: #6c757d !important;
        }

        a:hover {
            color: #fec503;
            text-decoration: none;
        }

        ::selection {
            background: #fec503;
            text-shadow: none;
        }

        footer {
            padding: 2rem 0;
            background-color: #212529;
        }

        .footer-column:not(:first-child) {
            padding-top: 2rem;
        }

        .footer-column {
            text-align: center;
        }

        ul.social-buttons {
            margin-bottom: 0;
        }

        ul.social-buttons li a:active,
        ul.social-buttons li a:focus,
        ul.social-buttons li a:hover {
            background-color: grey;
        }

        ul.social-buttons li a {
            font-size: 20px;
            line-height: 40px;
            display: block;
            width: 40px;
            height: 40px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
            color: #fff;
            border-radius: 100%;
            outline: 0;
            background-color: #1a1d20;
        }

        footer .quick-links {
            font-size: 90%;
            line-height: 40px;
            margin-bottom: 0;
            text-transform: none;
        }

        .copyright {
            color: white;
        }

        .footer-title {
            color: #fff;
        }

        .img-footer {
            height: 30px;
            max-height: 30px;
        }

        .img-logo {
            max-height: 50px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg sticky-top" style="min-height: 76px; background-color: #F8EDE3;">
            <div class="container">
                @if ($set->logo !== null)
                    <a class="navbar-brand fw-bold" href="/">
                        <img src="{{ asset('storage/setting_images') . $set->logo }}" class="img-logo"
                            alt="{{ $set->name }}">
                        Coffee App
                    </a>
                @else
                    <a class="navbar-brand fw-bold" href="/">Coffee App</a>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <i data-feather="menu" width="15"></i>
                </button>
                <div class="collapse navbar-collapse w-100" id="navbarText">
                    <ul class="navbar-nav ms-md-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/coffee">Kopi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/cart">
                                <i data-feather="shopping-cart" width="15"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span class="footer-title fs-4 fw-semibold">{{ $set->name }}</span>
                            </li>
                            <li class="nav-item pt-2">
                                <span class="footer-title">{{ $set->keywords . '. ' . $set->description }}</span>
                            </li>
                            <li class="nav-item pt-2">
                                <span class="footer-title">{{ 'Alamat ' . $set->address }}</span>
                            </li>
                            <li class="nav-item pt-2">
                                <span class="footer-title">{{ 'Buka ' . $set->service_time }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 pt-3 pt-md-0 ps-0 ps-md-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span class="footer-title ps-3">Company</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/coffee">Kopi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cart">Keranjang</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 pt-3 pt-md-0 ps-0 ps-md-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span class="footer-title ps-3">Contact</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i data-feather="phone" class="me-3"></i>{{ $set->phone }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i data-feather="mail" class="me-3"></i>{{ $user->email }}</a>
                            </li>
                    </div>
                </div>

                <div class="text-center text-white py-4"><i data-feather="more-horizontal"></i></div>

                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <span class="copyright quick-links">Copyright &copy; {{ $set->name }}
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <img src="../images/dicoding.png" alt="logo dicoding" class="img-footer rounded me-3">
                        <img src="../images/merdeka.png" alt="logo kampus merdeka" class="img-footer rounded">
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('app-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/notify-script.js') }}"></script>
    <script src="{{ asset('app-assets/js/helper.js') }}"></script>
    <script src="{{ asset('app-assets/js/sweet-alert/sweetalert2@11.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('layouts.includes.notify')

    <script>
        feather.replace()

        function addToCart(data) {
            let dataOrder = localStorage.getItem('data_order')
            let dataProducts = localStorage.getItem('data_products')

            console.log(data)

            const products = []
            if (dataProducts == null) {
                products.push({
                    id: data.id,
                    qty: 1,
                    price: parseInt(data.price),
                    total_price: 1 * parseInt(data.price),
                    name: data.name,
                    real_data: data,
                })
                const order = {
                    total_product: products.length,
                    total_price: 1 * parseInt(data.price)
                }
                localStorage.setItem('data_products', JSON.stringify(products))
                localStorage.setItem('data_order', JSON.stringify(order))
            } else {
                dataProducts = JSON.parse(dataProducts)
                dataOrder = JSON.parse(dataOrder)

                let same = false
                dataProducts.forEach(p => {
                    if (p.id == data.id) {
                        p.qty = p.qty + 1
                        p.total_price = p.qty * p.price
                        same = true
                    }
                });
                if (!same) {
                    dataProducts.push({
                        id: data.id,
                        qty: 1,
                        price: parseInt(data.price),
                        total_price: 1 * parseInt(data.price),
                        name: data.name,
                        real_data: data
                    })
                }

                let grandTotal = 0
                dataProducts.forEach((p) => {
                    grandTotal += p.total_price
                })

                dataOrder.total_product = dataProducts.length
                dataOrder.total_price = grandTotal

                localStorage.setItem('data_products', JSON.stringify(dataProducts))
                localStorage.setItem('data_order', JSON.stringify(dataOrder))
                hitNotifSuccess('Berhasil menambah ke keranjang')
            }
        }

        function minCart(id) {
            let dataOrder = localStorage.getItem('data_order')
            let dataProducts = localStorage.getItem('data_products')

            dataProducts = JSON.parse(dataProducts)
            dataOrder = JSON.parse(dataOrder)

            dataProducts.forEach(p => {
                if (p.id == id) {
                    p.qty = p.qty - 1
                    p.total_price = p.qty * p.price
                }
            });

            let grandTotal = 0
            dataProducts.forEach((p) => {
                grandTotal += p.total_price
            })

            dataOrder.total_product = dataProducts.length
            dataOrder.total_price = grandTotal

            localStorage.setItem('data_products', JSON.stringify(dataProducts))
            localStorage.setItem('data_order', JSON.stringify(dataOrder))
        }

        function plusCart(id) {
            let dataOrder = localStorage.getItem('data_order')
            let dataProducts = localStorage.getItem('data_products')

            dataProducts = JSON.parse(dataProducts)
            dataOrder = JSON.parse(dataOrder)

            dataProducts.forEach(p => {
                if (p.id == id) {
                    p.qty = p.qty + 1
                    p.total_price = p.qty * p.price
                }
            });

            let grandTotal = 0
            dataProducts.forEach((p) => {
                grandTotal += p.total_price
            })

            dataOrder.total_product = dataProducts.length
            dataOrder.total_price = grandTotal

            localStorage.setItem('data_products', JSON.stringify(dataProducts))
            localStorage.setItem('data_order', JSON.stringify(dataOrder))
        }

        function removeDataCart(id) {
            let dataOrder = localStorage.getItem('data_order')
            let dataProducts = localStorage.getItem('data_products')

            dataProducts = JSON.parse(dataProducts)
            dataOrder = JSON.parse(dataOrder)

            dataProducts.forEach((d, idx) => {
                if (d.id == id) {
                    dataProducts.splice(idx, 1)
                }
            })

            let grandTotal = 0
            dataProducts.forEach((p) => {
                grandTotal += p.total_price
            })

            dataOrder.total_product = dataProducts.length
            dataOrder.total_price = grandTotal

            localStorage.setItem('data_products', JSON.stringify(dataProducts))
            localStorage.setItem('data_order', JSON.stringify(dataOrder))
        }

        function hitNotifSuccess(msg) {
            $.notify({
                message: msg,
            }, {
                type: 'success',
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over: true,
                showProgressbar: false,
                spacing: 10,
                timer: 1000,
                placement: {
                    from: 'top',
                    align: 'center'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animated flash',
                    exit: 'animated swing'
                }
            });
        }

        function hitNotifError(msg) {
            $.notify({
                message: msg,
            }, {
                type: 'danger',
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over: true,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'center'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animated flash',
                    exit: 'animated swing'
                }
            });
        }
    </script>

    @yield('script')
</body>

</html>
