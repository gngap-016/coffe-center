@extends('layouts.dashboard') @section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Data Kategori</h2>
        </div>
        <div class="col-sm-4">
            <button
                type="button"
                class="btn btn-secondary float-end"
                data-bs-toggle="modal"
                data-bs-target="#addData"
            >
                + Tambah Data
            </button>
        </div>
        <div class="col-sm-12 mt-4">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Nama Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        {{-- <td>{{ $category->id }}</td> --}}
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editData{{$category->id}}"
                            >
                                Edit
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteData{{$category->id}}"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div
    class="modal fade modal-lg"
    id="addData"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                method="POST"
                action="category/addCategory"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_name" class="form-label"
                            >Nama Kategori</label
                        >
                        <input
                            type="text"
                            id="category_name"
                            name="category_name"
                            class="form-control"
                            placeholder="kategori"
                        />
                    </div>
                    <label for="category_status" class="form-label"
                        >Status</label
                    >
                    <select
                        id="category_status"
                        class="form-select"
                        name="category_status"
                        aria-label="Default select example"
                    >
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-secondary">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($categories as $category)
<div
    class="modal fade modal-lg"
    id="editData{{$category->id}}"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form
                method="POST"
                action="category/{{ $category->id }}/update"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_name" class="form-label"
                            >Nama Kategori</label
                        >
                        <input
                            type="text"
                            id="category_name"
                            name="category_name"
                            class="form-control"
                            placeholder="kategori"
                            value="{{ $category->name }}"
                        />
                    </div>
                    <label for="category_status" class="form-label"
                        >Status</label
                    >
                    <select
                        id="category_status"
                        class="form-select"
                        name="category_status"
                        aria-label="Default select example"
                    >
                        <option value="1" {{ ($category->
                            status == 1) ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="0" {{ ($category->
                            status == 0) ? 'selected' : '' }}>Non-Aktif
                        </option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Delete -->
@foreach ($categories as $category)
<div
    class="modal fade modal-lg"
    id="deleteData{{$category->id}}"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="category/{{ $category->id }}/destroy">
                <div class="modal-body">
                    Anda Yakin ingin menghapus <b>{{ $category->name }}</b>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach @endsection @section('script')
<script
    type="text/javascript"
    src="{{ asset('app-assets/js/jquery.dataTables.min.js') }}"
></script>
<script
    type="text/javascript"
    src="{{ asset('app-assets/js/dataTables.bootstrap5.min.js') }}"
></script>
<script>
    $(document).ready(function () {
        $("#dataTable").DataTable();
    });
</script>
@endsection

<style></style>
