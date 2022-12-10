@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4" style="position: relative">
            <div class="card" style="background: #F8EDE3">
                <div class="card-body p-5">
                    <h3 class="text-center mb-3 fw-bold">Cari Kopi Favoritmu!</h3>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Kopi..." aria-label="Search"
                            name="search">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        @if ($search)
            <div class="mb-4">
                <div class="d-flex justify-content-between w-100">
                    <h5 class="fw-bold align-self-center">Hasil Pencarianmu</h5>
                    <a href="/coffee" class="btn btn-secondary px-2">Kembali</a>
                </div>
                <hr class="border-main">
                <div class="d-flex flex-wrap">
                    @if (count($coffee) > 0)
                        @foreach ($coffee as $d)
                            <div class="card me-4 mb-4" style="width: 250px;">
                                <div class="card-body">
                                    @if ($d->thumbnail !== null)
                                        <img src="{{ asset('storage/product_images/thumbnail') . $d->thumbnail }}"
                                            class="rounded img-fluid mb-2" alt=""
                                            style="min-height: 153px; max-width: 213px backgroun: grey"
                                            alt="{{ $d->name }}">
                                    @else
                                        <img src="product-images/default.png" class="rounded img-fluid mb-2" alt=""
                                            style="min-height: 153px; max-width: 213px backgroun: grey"
                                            alt="{{ $d->name }}">
                                    @endif

                                    <p class="text-price mb-2">Rp{{ number_format($d->price) }}</p>
                                    <p class="fw-bold mb-2">{{ $d->name }}</p>

                                    <p class="text-category mb-2">
                                        {{ $d->category_name }}
                                    </p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-secondary" type="button"
                                            onclick="addToCart({{ $d }})">Tambah keranjang</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="my-5 text-center fw-semibold text-center w-100">Opps! Kopi tidak ditemukan</p>
                    @endif

                </div>
            </div>
        @else
            <div class="mb-4">
                <div class="d-flex justify-content-between w-100">
                    <h5 class="fw-bold align-self-center">Kopi Siap Seduh</h5>
                </div>
                <hr class="border-main">
                <div class="d-flex flex-wrap">
                    @foreach ($coffee as $d)
                        @if ($d->raw == 0)
                            <div class="card me-4 mb-4" style="width: 250px;">
                                <div class="card-body">
                                    @if ($d->thumbnail !== null)
                                        <img src="{{ asset('storage/product_images/thumbnail') . $d->thumbnail }}"
                                            class="rounded img-fluid mb-2" alt=""
                                            style="min-height: 153px; max-width: 213px backgroun: grey"
                                            alt="{{ $d->name }}">
                                    @else
                                        <img src="product-images/default.png" class="rounded img-fluid mb-2" alt=""
                                            style="min-height: 153px; max-width: 213px backgroun: grey"
                                            alt="{{ $d->name }}">
                                    @endif

                                    <p class="text-price mb-2">Rp{{ number_format($d->price) }}</p>
                                    <p class="fw-bold mb-2">{{ $d->name }}</p>

                                    <p class="text-category mb-2">
                                        {{ $d->category_name }}
                                    </p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-secondary" type="button"
                                            onclick="addToCart({{ $d }})">Tambah keranjang</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between w-100">
                    <h5 class="fw-bold align-self-center">Bibit Kopi</h5>
                </div>
                <hr class="border-main">
                <div class="d-flex flex-wrap">
                    @foreach ($coffee as $d)
                        @if ($d->raw == 1)
                            <div class="card me-4 mb-4" style="width: 250px;">
                                <div class="card-body">
                                    @if ($d->thumbnail !== null)
                                        <img src="{{ asset('storage/product_images/thumbnail') . $d->thumbnail }}"
                                            class="rounded img-fluid mb-2" alt=""
                                            style="min-height: 153px; max-width: 213px backgroun: grey"
                                            alt="{{ $d->name }}">
                                    @else
                                        <img src="product-images/default.png" class="rounded img-fluid mb-2" alt=""
                                            style="min-height: 153px; max-width: 213px backgroun: grey"
                                            alt="{{ $d->name }}">
                                    @endif

                                    <p class="text-price mb-2">Rp{{ number_format($d->price) }}</p>
                                    <p class="fw-bold mb-2">{{ $d->name }}</p>

                                    <p class="text-category mb-2">
                                        {{ $d->category_name }}
                                    </p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-secondary" type="button"
                                            onclick="addToCart({{ $d }})">Tambah keranjang</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
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
