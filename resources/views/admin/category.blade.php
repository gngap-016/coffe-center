@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Data Kategori</h2>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-secondary float-end">+ Tambah Data</button>
        </div>
        <div class="col-sm-12 mt-4">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->status }}</td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('app-assets/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection

<style>

</style>
