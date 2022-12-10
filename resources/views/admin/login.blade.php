@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex" style="height: 80vh">
            <div class="card m-auto" style="max-width: 500px">

                <img class="mx-auto py-2 pt-4" style="max-width: 50px !important"
                    src="{{ asset('app-assets/icon/store.png') }}" alt="{{ asset('app-assets/icon/store.png') }}">

                <div class="card-body pt-4">
                    @guest
                        <center>
                            <h6 class="p-0 m-0 fw-bold">Login</h6>
                        </center>
                        <form method="POST" class="row" action="{{ route('login.store') }}">
                            @csrf
                            <div class="col-12 mb-3">
                                <label for="email" class="form-label text-cen">
                                    Alamat email<span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="alamat email"
                                    value="{{ old('email') }}" autofocus>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="password" class="form-label">
                                    Kata sandi<span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" placeholder="*********" name="password">
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-secondary w-100">Masuk</button>
                            </div>
                            <div class="col-12 text-center">
                                <small style="font-size: 8px !important">Copyright 2022 Coffee App</small>
                            </div>
                        </form>
                    @else
                        <div class="col-12 mb-3">
                            <a href="{{ route('admin.account.index') }}" class="btn btn-secondary w-100">Kembali ke
                                dahsboard</a>
                        </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
@endsection
