@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>  Setting Toko</h2>
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
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Instagram</th>
                        <th>Facebook</th>
                        <th>Email</th>
                        <th>Whatsapp</th>
                        <th>Phone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php
                        $no = 1;
                    @endphp
                    @foreach ($settings as $setting)
                    <tr>
                    
                    <td>{{ $no++ }}</td>
                     <td>
                            @if ($setting->thumbnail !== null)
                            <img src="images/thumbnail/{{ $setting->thumbnail }}" class="img-thumbnail"
                                width="40px" alt="{{ $setting->name }}">
                            @else
                            <img src="images/logo.png" class="img-thumbnail" width="40px"
                                alt="{{ $setting->name }}">
                            @endif
                        </td>
                        
                        <td>{{ $setting->name }}</td>
                        <td>{{ $setting->address }}</td>
                        <td>{{ $setting->instagram }}</td>
                        <td>{{ $setting->facebook }}</td>
                        <td>{{ $setting->email }}</td>
                        <td>{{ $setting->whatsapp }}</td>
                        <td>{{ $setting->phone }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editData{{$setting->id}}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteData{{$setting->id}}">
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
            <form method="POST" action="setting/addSetting" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- <div class="col-sm-4">
                            <p class="text-center fw-bold">Logo Produk</p>
                            <p class="text-danger text-center">Maksimal Ukuran Foto 1024KB / 1MB dengan format .JPG
                                .JPEG .PNG</p>
                            <div class="form-group text-center">
                                <img src="setting-images/default.png" alt="" id="gambar_load" class="img-logo"
                                    style="max-width: 300px; max-height: 300px;">
                                <br>
                                <p class="fotoLabel">Preview Foto</p>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="file" name="setting_logo" class="form-control" id="preview_gambar"
                                        onchange="previewImg()" accept="image/*">
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label for="setting_name" class="form-label">Nama Pemilik</label>
                                <input type="text" id="setting_name" name="setting_name" class="form-control"
                                    placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label for="setting_address" class="form-label">Address</label>
                                <input type="text" id="setting_address" name="setting_address" class="form-control"
                                    placeholder="20">
                            </div>
                            <div class="mb-3">
                                <label for="setting_instagram" class="form-label">Instagram</label>
                                <input type="text" id="setting_instagram" name="setting_instagram" class="form-control"
                                    placeholder="@lokontre">
                            </div>
                            <div class="mb-3">
                                <label for="setting_facebook" class="form-label">Facebook</label>
                                <input type="text" id="setting_facebook" name="setting_facebook" class="form-control"
                                    placeholder="@lokontre">
                            </div>
                            <div class="mb-3">
                                <label for="setting_email" class="form-label">Email</label>
                                <input type="text" id="setting_email" name="setting_email" class="form-control"
                                    placeholder="aku@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="setting_whatsapp" class="form-label">WhatsApp</label>
                                <input type="number" id="setting_whatsapp" name="setting_whatsapp" class="form-control"
                                    placeholder="@lokontre">
                            </div>
                            <div class="mb-3">
                                <label for="setting_phone" class="form-label">Phone</label>
                                <input type="number" id="setting_phone" name="setting_phone" class="form-control"
                                    placeholder="@lokontre">
                            </div>
                            <div class="mb-3">
                                <label for="setting_service_time" class="form-label">Service Time</label>
                                <input type="number" id="setting_service_time" name="setting_service_time" class="form-control"
                                    placeholder="@lokontre">
                            </div>
                            <div class="mb-3">
                                <label for="setting_keywords" class="form-label">Keywords</label>
                                <input type="number" id="setting_keywords" name="setting_keywords" class="form-control"
                                    placeholder="@lokontre">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="setting_description" class="form-label">Deskripsi Produk</label>
                                <textarea id="setting_description" name="setting_description" class="form-control"
                                    rows="10"></textarea>
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
@foreach ($settings as $setting)
<div class="modal fade modal-xl" id="editData{{$setting->id}}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="setting/{{ $setting->id }}/update" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="text-center fw-bold">Logo Produk</p>
                            <p class="text-danger text-center">Maksimal Ukuran Foto 1024KB / 1MB dengan format .JPG
                                .JPEG .PNG</p>
                            <div class="form-group text-center">
                                <img src="setting-images/{{ ($setting->logo !== null) ? $setting->logo : 'default.png' }}"
                                    alt="" id="gambar_load{{$setting->id}}" class="img-logo"
                                    style="max-width: 300px; max-height: 300px;">
                                <br>
                                <label class="fotoLabel{{$setting->id}}">Preview Foto</label>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="file" name="setting_logo" class="form-control"
                                        id="preview_gambar{{$setting->id}}" onchange="previewImgEdt{{$setting->id}}()">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label for="setting_name" class="form-label">Penjual</label>
                                <input type="text" id="setting_name" name="setting_name" class="form-control"
                                    placeholder="agus" value="{{$setting->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_address" class="form-label">Address</label>
                                <input type="text" id="setting_address" name="setting_address" class="form-control"
                                    placeholder="p.tj" value="{{$setting->address}}">
                            </div>
                           
                            <div class="mb-3">
                                <label for="setting_instagram" class="form-label">Instagram</label>
                                <input type="text" id="setting_instagram" name="setting_instagram" class="form-control"
                                    placeholder="@lokontre" value="{{$setting->instagram}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_facebook" class="form-label">Facebook</label>
                                <input type="text" id="setting_facebook" name="setting_facebook" class="form-control"
                                    placeholder="@lokontre" value="{{$setting->facebook}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_email" class="form-label">Email</label>
                                <input type="text" id="setting_email" name="setting_email" class="form-control"
                                    placeholder="aku@gmail.com" value="{{$setting->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_whatsapp" class="form-label">WhatsApp</label>
                                <input type="number" id="setting_whatsapp" name="setting_whatsapp" class="form-control"
                                    placeholder="@lokontre" value="{{$setting->whatsapp}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_phone" class="form-label">Phone</label>
                                <input type="number" id="setting_phone" name="setting_phone" class="form-control"
                                    placeholder="@lokontre" value="{{$setting->phone}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_service_time" class="form-label">Service Time</label>
                                <input type="number" id="setting_service_time" name="setting_service_time" class="form-control"
                                    placeholder="@lokontre" value="{{$setting->service_time}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_keywords" class="form-label">Keywords</label>
                                <input type="number" id="setting_keywords" name="setting_keywords" class="form-control"
                                    placeholder="@lokontre" value="{{$setting->keywords}}">
                            </div>
                        </div>
                            <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="setting_description" class="form-label">Deskripsi Produk</label>
                                <textarea id="setting_description" name="setting_description" class="form-control"
                                    rows="10">{{$setting->description}}</textarea>
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
@foreach ($settings as $setting)
<div class="modal fade modal-lg" id="deleteData{{$setting->id}}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="setting/{{ $setting->id }}/destroy">
                <div class="modal-body">
                    Anda Yakin ingin menghapus <b>{{ $setting->name }}</b>
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
        const fotoLabel = document.querySelector('.fotoLabel');
        const fotoLoad = document.querySelector('#gambar_load');

        fotoLabel.textContent = foto.files[0].name;

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function (e) {
            fotoLoad.src = e.target.result;
        }
    }

    // preview gambar edit
    @foreach($settings as $setting)
        function previewImgEdt{{$setting->id}}() {
            const foto{{ $setting-> id}} = document.querySelector('#preview_gambar{{$setting->id}}');
            const fotoLabel{{ $setting-> id}} = document.querySelector('.fotoLabel{{$setting->id}}');
            const fotoLoad{{ $setting-> id}}  = document.querySelector('#gambar_load{{$setting->id}}');

            fotoLabel{{ $setting -> id }}.textContent = foto{{ $setting -> id }}.files[0].name;

            const fileFoto{{ $setting-> id}} = new FileReader();
            fileFoto{{ $setting -> id }}.readAsDataURL(foto{{ $setting-> id}}.files[0]);
            
            fileFoto{{ $setting -> id }}.onload = function (e) {
                fotoLoad{{ $setting -> id }}.src = e.target.result;
            }
        }
    @endforeach
</script>
@endsection

<style></style>
