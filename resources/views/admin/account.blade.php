@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Hallo, {{ $user->name }}</h2>
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Insight</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card text-bg-secondary mb-3">
                                <div class="card-body">
                                  Total Produk
                                  <h5>{{ $total_product }}</h5>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-bg-warning mb-3">
                                <div class="card-body">
                                  Total Kategori
                                  <h5>{{ $total_category }}</h5>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Data Kamu</span>
                    <button
                            type="button"
                            class="btn btn-warning btn-sm float-end"
                            data-bs-toggle="modal"
                            data-bs-target="#editUser"
                    >
                        Ubah
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Username</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <th>{{ $user->email }}
                                @if ($user->email_verified_at == null)
                                <button
                                        type="button"
                                        class="btn btn-primary btn-sm float-end"
                                        data-bs-toggle="modal"
                                        data-bs-target="#verifyEmail"
                                >
                                    Verifikasi
                                </button>   
                                @endif
                            </th>
                        </tr>
                    </table>
                    <hr>
                    <button
                            type="button"
                            class="btn btn-danger btn-sm float-end"
                            data-bs-toggle="modal"
                            data-bs-target="#changePassword"
                    >
                        Ubah Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- Modal Ubah Data Admin --}}
<div
    class="modal fade modal-lg"
    id="editUser"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data {{ $user->name }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                method="POST"
                action=""
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_name" class="form-label"
                            >Username</label
                        >
                        <input
                            type="text"
                            id="user_name"
                            name="user_name"
                            class="form-control"
                            placeholder="Username"
                            value="{{ $user->name }}"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="form-label"
                            >Email</label
                        >
                        <input
                            type="text"
                            id="user_email"
                            name="user_email"
                            class="form-control"
                            placeholder="email@email.com"
                            value="{{ $user->email }}"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Modal Ubah Password Admin --}}
<div
    class="modal fade modal-lg"
    id="changePassword"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password {{ $user->name }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                method="POST"
                action=""
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="old_password" class="form-label"
                            >Password Lama</label
                        >
                        <input
                            type="text"
                            id="old_password"
                            name="old_password"
                            class="form-control"
                            placeholder="password"
                        />
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="new_password" class="form-label"
                            >Password Baru</label
                        >
                        <input
                            type="text"
                            id="new_password"
                            name="new_password"
                            class="form-control"
                            placeholder="password"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="repeat_new_password" class="form-label"
                            >Ulangi Password Baru</label
                        >
                        <input
                            type="text"
                            id="repeat_new_password"
                            name="repeat_new_password"
                            class="form-control"
                            placeholder="password"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- Modal Verifikasi Email Admin --}}
<div
    class="modal fade modal-lg"
    id="verifyEmail"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Email {{ $user->name }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                method="POST"
                action=""
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_email" class="form-label"
                            >Email</label
                        >
                        <input
                            type="text"
                            id="user_email"
                            name="user_email"
                            class="form-control"
                            placeholder="email@email.com"
                            value="{{ $user->email }}"
                            readonly
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection

<style>

</style>
