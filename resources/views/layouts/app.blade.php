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
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg sticky-top" style="min-height: 76px; background-color: #F8EDE3;">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">Coffee App</a>
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
