@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="cart-form" action="{{ route('home.order') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="d-flex w-100 justify-content-center">
                <div class="card mb-4" style="max-width: 450px;  width: 100%">
                    <div class="card-body pt-4">
                        <p class="text-center mb-2 fs-5 fw-bold">Keranjang Belanja</p>
                        <hr>
                        <div id="order-detail" class="d-none">
                            <p class="fw-bold text-grey mt-4">Barang</p>
                            <div id="data-order">

                            </div>
                            <p class="fw-bold text-grey mt-4">Data Pemesan</p>
                            <div>
                                <div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telp" class="form-label">No WhatsApp</label>
                                        <input type="number" class="form-control" id="telp" placeholder="081xxxxx"
                                            name="telp" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city-ongkir" class="form-label d-block">Kota</label>
                                        <select id="city-ongkir" class="form-control d-block ongkir" name="city"
                                            style="width: 100%; min-height: 38px" required>
                                            <option></option>
                                            @foreach ($city as $c)
                                                <option value="{{ $c->city_id }}">{{ $c->type . ' ' . $c->city_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" id="full-address" name="full_address" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Catatan</label>
                                        <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <p class="fw-bold text-grey mt-4">Order Detail</p>
                            <div>
                                <div class="d-flex justify-content-between mb-1" style="font-size: 13px"><span>Sub
                                        Total</span>
                                    <span id="subtotal" class="text-right">Rp10.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1" style="font-size: 13px">
                                    <span id="ongkir-title">Ongkir</span>
                                    <span id="ongkir" class="float-right">Rp20.000</span>
                                </div>
                                <div class="fw-bold d-flex justify-content-between"><span>Total</span> <span id="total"
                                        class="float-right">Rp10.000</span></div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-secondary" type="button" onclick="order()">Pesan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="products" id="all-products">
                <input type="hidden" name="ongkir" id="ongkir-form">
                <input type="hidden" name="courier" id="courier-form">
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        let dataProducts = localStorage.getItem('data_products')
        let dataOrder = localStorage.getItem('data_order')
        $('#all-products').val(dataProducts)

        function refreshData() {
            dataProducts = localStorage.getItem('data_products')
            dataOrder = localStorage.getItem('data_order')
            $('#data-order').html('')
            setDataCart()
            // $("#city-ongkir").val(null).trigger('change');
            location.reload()
            $('#all-products').val(null)
            $('#all-products').val(dataProducts)
        }

        function cartEditMin(idx) {
            minCart(idx)
            refreshData()
        }

        function cartEditPlus(idx) {
            plusCart(idx)
            refreshData()
        }

        function cartEditDel(idx) {
            removeDataCart(idx)
            refreshData()
        }

        function numberFormat(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function setDataCart() {
            if (dataProducts == null || dataProducts == '[]') {
                $('#order-detail').html('')
                $('#order-detail').append(`<p class="text-center">Keranjang Kosong</p>`)
                $('#order-detail').removeClass('d-none')
            } else {
                $('#order-detail').removeClass('d-none')
                dataProducts = JSON.parse(dataProducts)
                dataOrder = JSON.parse(dataOrder)
                dataProducts.forEach(p => {
                    let html = `
                        <div>
                            <div class="d-flex">`

                    if (p.real_data.thumbnail !== null) {
                        html += `
                                <img src="/storage/product_images/thumbnail/${p.real_data.thumbnail}" class="rounded img-thumbnail" style="max-width: 80px; max-height: 80px; min-height: 80px; object-fit: cover">
                                        <div class="mx-2 w-100">
                                            <p class="mb-0 fw-bold">${p.name}</p>
                                            <p style="font-size: 14px">Rp${numberFormat(p.price)}</p>
                                            <div class="d-flex justify-content-end w-100">
                                `
                    } else {
                        html += `
                                <img src="product-images/default.png" class="rounded img-thumbnail" style="max-width: 80px; max-height: 80px; min-height: 80px; object-fit: cover">
                                        <div class="mx-2 w-100">
                                            <p class="mb-0 fw-bold">${p.name}</p>
                                            <p style="font-size: 14px">Rp${numberFormat(p.price)}</p>
                                            <div class="d-flex justify-content-end w-100">
                                `
                    }

                    if (p.qty > 1) {
                        html += `
                                        <button class="btn btn-sm btn-secondary" onclick="cartEditMin(` + p.id + `)">
                                            <i data-feather="minus" width="15"></i>
                                        </button>
                                        <span class="mx-3 align-self-center">${p.qty}</span>
                                        <button class="btn btn-sm btn-secondary" onclick="cartEditPlus(` + p.id + `)">
                                            <i data-feather="plus" width="15"></i>
                                        </button>
                                        <button class="btn btn-sm ms-2 btn-danger" onclick="cartEditDel(` + p.id + `)">
                                            <i data-feather="trash" width="15"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        `
                    } else {
                        html += `
                                        <span class="mx-3 align-self-center">${p.qty}</span>
                                        <button class="btn btn-sm btn-secondary" onclick="cartEditPlus(` + p.id + `)">
                                            <i data-feather="plus" width="15"></i>
                                        </button>
                                        <button class="btn btn-sm ms-2 btn-danger" onclick="cartEditDel(` + p.id + `)">
                                            <i data-feather="trash" width="15"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        `
                    }

                    $('#data-order').append(html)
                    feather.replace()
                });

                $('#subtotal').text('Rp' + numberFormat(dataOrder.total_price))
                $('#ongkir-form').val(10000)
                $('#total').text('Rp' + numberFormat(parseInt(dataOrder.total_price) + 20000))
            }

        }

        $('#city-ongkir').select2({
            width: 'style',
            placeholder: 'Pilih Kota Tujuan',
            allowClear: true
        })

        $('#city-ongkir').on('change', function() {
            const data = $("#city-ongkir option:selected").val();
            let w = 0
            dataProducts.forEach((p) => {
                if (p.real_data.raw === 1) {
                    w += p.qty * 500
                } else {
                    w += p.qty * 100
                }
            })
            const p = {
                // Asal default lampung
                origin: 21,
                destination: data,
                weight: w,
                courier: "jne"
            }

            $.ajax({
                type: "get",
                url: '{{ route('home.courier') }}',
                data: p,
                success: function(response) {
                    const c = response.data.results[0]
                    $('#ongkir').text(
                        'Rp' + numberFormat(c.costs[0].cost[0].value))
                    $('#ongkir-title').text('Ongkir (' + c.code.toUpperCase() + ' ' + c.costs[0]
                        .service + ') ')
                    $('#ongkir-form').val(c.costs[0].cost[0].value)
                    $('#courier-form').val(c.code.toUpperCase() + ' ' + c.costs[0]
                        .service)
                    $('#total').text('Rp' + numberFormat(parseInt(dataOrder.total_price) + c.costs[0]
                        .cost[0].value))
                }
            });
        })

        function order() {
            if ($('#name').val() == '') {
                hitNotifError('Nama wajib diisi')
            } else if ($('#telp').val() == '') {
                hitNotifError('No. WhatsApp wajib diisi')
            } else if ($('#city-ongkir').val() == '') {
                hitNotifError('Kota belum dipilih')
            } else if (!$.trim($("#full-address").val())) {
                hitNotifError('Alamat lengkap wajib diisi')
            } else {
                $('#cart-form').submit()
            }
        }

        setDataCart()
    </script>
@endsection

<style>
    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .text-stroke {
        -webkit-text-stroke-width: 2px;
        -webkit-text-stroke-color: #7D6E83;
    }

    .border-main {
        border: 4px solid #7E6F83;
        background: #7E6F83;
        opacity: 1;
        border-radius: 50px;
    }

    .text-price {
        font-weight: 700;
        font-size: 20px;
        line-height: 30px;
        color: #7E6F83;
    }

    .text-category {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 700;
        font-size: 14px;
        line-height: 21px;
        color: #D0B8A8;
    }

    .card {
        border: 1px solid transparent !important;
        box-shadow: 0px 5.38264px 18.8392px rgba(0, 0, 0, 0.08);
        border-radius: 16px;
    }
</style>
