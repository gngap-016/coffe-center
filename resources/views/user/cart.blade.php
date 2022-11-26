@extends('layouts.app')

@section('content')
<div class="container">
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
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">No WhatsApp</label>
                                <input type="number" class="form-control" id="telp" placeholder="081xxxxx">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <p class="fw-bold text-grey mt-4">Order Detail</p>
                    <div>
                        <div class="d-flex justify-content-between mb-1" style="font-size: 13px"><span>Sub Total</span> <span id="subtotal" class="text-right">Rp10.000</span></div>
                        <div class="d-flex justify-content-between mb-1" style="font-size: 13px"><span>Ongkir</span> <span id="ongkir"  class="float-right">Rp10.000</span></div>
                        <div class="fw-bold d-flex justify-content-between"><span>Total</span> <span id="total" class="float-right">Rp10.000</span></div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-secondary" type="button">Pesan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    let dataProducts = localStorage.getItem('data_products')
    let dataOrder = localStorage.getItem('data_order')

    function refreshData() {
        dataProducts = localStorage.getItem('data_products')
        dataOrder = localStorage.getItem('data_order')
        $('#data-order').html('')
        setDataCart()
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
        if (dataProducts == null) {
            $('#order-detail').html('')
            $('#order-detail').append(`<p class="text-center">Keranjang Kosong</p>`)
            $('#order-detail').removeClass('d-none')
        } else {
            $('#order-detail').removeClass('d-none')
            dataProducts = JSON.parse(dataProducts)
            dataOrder = JSON.parse(dataOrder)
            dataProducts.forEach(p => {
                    const html= `
                        <div>
                            <div class="d-flex">
                                <img src="../images/banner-coffee.png" class="rounded img-thumbnail" style="max-width: 80px; max-height: 80px; min-height: 80px; object-fit: cover">
                                <div class="mx-2 w-100">
                                    <p class="mb-0 fw-bold">${p.name}</p>
                                    <p style="font-size: 14px">Rp${numberFormat(p.price)}</p>
                                    <div class="d-flex justify-content-end w-100">
                                        <button class="btn btn-sm btn-secondary" onclick="cartEditMin(`+p.id+`)">
                                            <i data-feather="minus" width="15"></i>
                                        </button>
                                        <span class="mx-3 align-self-center">${p.qty}</span>
                                        <button class="btn btn-sm btn-secondary" onclick="cartEditPlus(`+p.id+`)">
                                            <i data-feather="plus" width="15"></i>
                                        </button>
                                        <button class="btn btn-sm ms-2 btn-danger" onclick="cartEditDel(`+p.id+`)">
                                            <i data-feather="trash" width="15"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    `
                    $('#data-order').append(html)
                    feather.replace()
                });

            $('#subtotal').text('Rp'+numberFormat(dataOrder.total_price))
            $('#ongkir').text('Rp20,000')
            $('#total').text('Rp'+numberFormat(parseInt(dataOrder.total_price)+20000))
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
        /* identical to box height */


        color: #D0B8A8;
    }

    .card {
        border: 1px solid transparent !important;
        box-shadow: 0px 5.38264px 18.8392px rgba(0, 0, 0, 0.08);
        border-radius: 16px;
    }
</style>
