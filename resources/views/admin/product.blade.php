@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Data Produk</h2>
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addData">
                + Tambah Data
            </button>
        </div>
        <div class="col-sm-12 mt-4">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Banyak</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            @if ($product->thumbnail !== null)
                            <img src="{{ asset('storage/product_images/thumbnail').$product->thumbnail }}"
                                class="img-thumbnail" width="40px" alt="{{ $product->name }}">
                            @else
                            <img src="product-images/default.png" class="img-thumbnail" width="40px"
                                alt="{{ $product->name }}">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{
                            ($product->raw == 0) ? 'Bubuk' : 'Mentah / Bibit'
                            }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>Rp. {{ number_format($product->price) }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editData{{$product->id}}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteData{{$product->id}}">
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
<div class="modal fade modal-xl" id="addData" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="product/addProduct" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="text-center fw-bold">Foto Produk</p>
                            <p class="text-danger text-center">Maksimal Ukuran Foto 1024KB / 1MB dengan format .JPG
                                .JPEG .PNG</p>
                            <div class="form-group text-center">
                                <img src="product-images/default.png" alt="" id="gambar_load" class="img-thumbnail"
                                    style="max-width: 300px; max-height: 300px;">
                                <br>
                                <p class="fotoLabel">Preview Foto</p>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="file" name="product_banner"
                                        class="form-control @error('product_banner') is-invalid @enderror"
                                        id="preview_gambar" onchange="previewImg()" accept="image/*">
                                    @error('product_banner')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Nama Produk <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="product_name" name="product_name"
                                    class="form-control @error('product_name') is-invalid @enderror"
                                    placeholder="Produk">
                                @error('product_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <label for="category_id" class="form-label">Kategori <span
                                    class="text-danger">*</span></label>
                            <select id="category_id" class="form-select mb-3" name="category_id" aria-label="Kategori">
                                @foreach ($categories as $category)
                                @if($category->status == 1){
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                }
                                @endif
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="product_quantity" class="form-label">Banyak <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="product_quantity" name="product_quantity"
                                    class="form-control @error('product_quantity') is-invalid @enderror"
                                    placeholder="20">
                                @error('product_quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Harga <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="product_price" name="product_price"
                                    class="form-control @error('product_price') is-invalid @enderror"
                                    placeholder="20000">
                                @error('product_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="product_description" class="form-label">Deskripsi Produk <span
                                        class="text-danger">*</span></label>
                                <textarea id="product_description" name="product_description"
                                    class="form-control @error('product_description') is-invalid @enderror"
                                    rows="10"></textarea>
                                @error('product_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_status" class="form-label">Kondisi <span
                                        class="text-danger">*</span></label>
                                <select id="product_status" class="form-select " name="product_raw"
                                    aria-label="Default select example">
                                    <option value="1">Mentah / Bibit</option>
                                    <option value="0">Bubuk</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product_status" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select id="product_status" class="form-select" name="product_status"
                                    aria-label="Default select example">
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-secondary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($products as $product)
<div class="modal fade modal-xl" id="editData{{$product->id}}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="product/{{ $product->id }}/update" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="text-center fw-bold">Foto Produk</p>
                            <p class="text-danger text-center">Maksimal Ukuran Foto 1024KB / 1MB dengan format .JPG
                                .JPEG .PNG</p>
                            <div class="form-group text-center">
                                <!-- Tampilan Gambar -->
                                <input type="hidden" name="oldImage" value="{{$product->banner}}">
                                @if ($product->banner !== null)
                                <img src="{{ asset('storage/product_images').$product->banner }}" alt=""
                                    id="gambar_load{{$product->id}}" class="img-thumbnail"
                                    style="max-width: 300px; max-height: 300px;">
                                @else
                                <img src="product-images/default.png" class="img-thumbnail"
                                    id="gambar_load{{$product->id}}" style="max-width: 300px; max-height: 300px;"
                                    alt="{{ $product->name }}">
                                @endif

                                <br>
                                <label class="fotoLabel{{$product->id}}">Preview Foto</label>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="file" name="product_banner"
                                        class="form-control @error('product_banner') is-invalid @enderror"
                                        id="preview_gambar{{$product->id}}" accept="image/*"
                                        onchange="previewImgEdt{{$product->id}}()">
                                    @error('product_banner')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input type="text" id="product_name" name="product_name" class="form-control"
                                    placeholder="Produk" value="{{$product->name}}">
                            </div>
                            <label for="category_id" class="form-label">Kategori</label>
                            <select id="category_id" class="form-select mb-3" name="category_id" aria-label="Kategori">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ?
                                    'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="product_quantity" class="form-label">Banyak</label>
                                <input type="number" id="product_quantity" name="product_quantity" class="form-control"
                                    placeholder="20" value="{{$product->quantity}}">
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Harga</label>
                                <input type="number" id="product_price" name="product_price" class="form-control"
                                    placeholder="20000" value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="product_description" class="form-label">Deskripsi Produk</label>
                                <textarea id="product_description" name="product_description" class="form-control"
                                    rows="10">{{$product->description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="product_status" class="form-label">Kondisi</label>
                                <select id="product_status" class="form-select" name="product_raw"
                                    aria-label="Default select example">
                                    <option value="1" {{ ($product->raw == 1) ? 'selected' : '' }}>Mentah / Bibit
                                    </option>
                                    <option value="0" {{ ($product->raw == 0) ? 'selected' : '' }}>Bubuk</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product_status" class="form-label">Status</label>
                                <select id="product_status" class="form-select" name="product_status"
                                    aria-label="Default select example">
                                    <option value="1" {{ ($product->status == 1) ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ ($product->status == 0) ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Delete -->
@foreach ($products as $product)
<div class="modal fade modal-lg" id="deleteData{{$product->id}}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="product/{{ $product->id }}/destroy">
                <input type="hidden" name="oldImage" value="{{$product->banner}}">
                <div class="modal-body">
                    Anda Yakin ingin menghapus <b>{{ $product->name }}</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('app-assets/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });

    // preview gambar
    function previewImg() {
        const foto = document.querySelector('#preview_gambar');
        // const fotoLabel = document.querySelector('.fotoLabel');
        const fotoLoad = document.querySelector('#gambar_load');

        // fotoLabel.textContent = foto.files[0].name;

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function (e) {
            fotoLoad.src = e.target.result;
        }
    }

    // preview gambar edit
    @foreach($products as $product)
        function previewImgEdt{{ $product -> id }}() {
            const foto{{ $product-> id}} = document.querySelector('#preview_gambar{{$product->id}}');
            // const fotoLabel{{ $product-> id}} = document.querySelector('.fotoLabel{{$product->id}}');
            const fotoLoad{{ $product-> id}}  = document.querySelector('#gambar_load{{$product->id}}');

            // fotoLabel{{ $product -> id }}.textContent = foto{{ $product -> id }}.files[0].name;

            const fileFoto{{ $product-> id}} = new FileReader();
            fileFoto{{ $product -> id }}.readAsDataURL(foto{{ $product-> id}}.files[0]);
            
            fileFoto{{ $product -> id }}.onload = function (e) {
                fotoLoad{{ $product -> id }}.src = e.target.result;
            }
        }
    @endforeach
</script>
@endsection

<style></style>