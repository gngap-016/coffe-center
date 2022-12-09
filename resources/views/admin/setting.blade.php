@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Pengaturan Toko</h2>
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#editData">
                Edit Data
            </button>
        </div>
        <div class="col-sm-12 mb-3">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    @if ($setting->logo !== null)
                    <img src="{{ asset('storage/setting_images').$setting->logo }}" class="img-logo img-thumbnail"
                        width="100%" alt="{{ $setting->name }}">
                    @else
                    <img src="product-images/default.png" class="img-logo img-thumbnail" alt="{{ $setting->name }}">
                    @endif
                </div>
                <div class="col-sm-8 mb-3">
                    <table class="table">
                        <tr>
                            <th>Nama Toko</th>
                            <td>: {{ $setting->name }}</td>
                        </tr>
                        <tr>
                            <th>Moto</th>
                            <td>: {{ $setting->keywords }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Pelayanan</th>
                            <td>: {{ $setting->service_time }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Toko</th>
                            <td>: {{ $setting->description }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12 mb-3">
                    <table class="table">
                        <tr>
                            <th>Telepon</th>
                            <td>: {{ $setting->phone }}</td>
                        </tr>
                        <tr>
                            <th>WhatsApp</th>
                            <td>: {{ $setting->whatsapp }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $setting->email }}</td>
                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <td>: {{ $setting->facebook }}</td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>: {{ $setting->instagram }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $setting->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade modal-xl" id="editData" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <p class="text-center fw-bold">Logo Toko</p>
                            <div class="form-group text-center">
                                <input type="hidden" name="oldImage" value="{{$setting->logo}}">
                                @if ($setting->logo !== null)
                                <img src="{{ asset('storage/setting_images').$setting->logo }}" alt="{{$setting->name}}"
                                    id="gambar_load" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                                @else
                                <img src="product-images/default.png" class="img-thumbnail" id="gambar_load"
                                    style="max-width: 300px; max-height: 300px;" alt="{{$setting->name}}">
                                @endif
                                <br>
                                <label class="fotoLabel">Preview Foto</label>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="file" name="setting_logo" class="form-control" id="preview_gambar"
                                        accept="image/*" onchange="previewImg()">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label for="setting_name" class="form-label">Nama Toko</label>
                                <input type="text" id="setting_name" name="setting_name" class="form-control"
                                    placeholder="Nama Toko" value="{{$setting->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_keywords" class="form-label">Moto Toko</label>
                                <input type="text" id="setting_keywords" name="setting_keywords" class="form-control"
                                    placeholder="Moto Toko" value="{{$setting->keywords}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_service_time" class="form-label">Waktu Pelayanan</label>
                                <input type="text" id="setting_service_time" name="setting_service_time"
                                    class="form-control" placeholder="08:00 - 19:00" value="{{$setting->service_time}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_description" class="form-label">Deskripsi Toko</label>
                                <textarea id="setting_description" name="setting_description" class="form-control"
                                    rows="5">{{$setting->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="setting_phone" class="form-label">Telepon</label>
                                <input type="text" id="setting_phone" name="setting_phone" class="form-control"
                                    placeholder="6285263193452" value="{{$setting->phone}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_whatsapp" class="form-label">Whatsapp</label>
                                <input type="text" id="setting_whatsapp" name="setting_whatsapp" class="form-control"
                                    placeholder="6285263193452" value="{{$setting->whatsapp}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_email" class="form-label">Email</label>
                                <input type="text" id="setting_email" name="setting_email" class="form-control"
                                    placeholder="email@email.com" value="{{$setting->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_facebook" class="form-label">Facebook</label>
                                <input type="text" id="setting_facebook" name="setting_facebook" class="form-control"
                                    placeholder="Facebook_Username" value="{{$setting->facebook}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_instagram" class="form-label">Instagram</label>
                                <input type="text" id="setting_instagram" name="setting_instagram" class="form-control"
                                    placeholder="@instagram_username" value="{{$setting->instagram}}">
                            </div>
                            <div class="mb-3">
                                <label for="setting_address" class="form-label">Alamat Toko</label>
                                <textarea id="setting_address" name="setting_address" class="form-control"
                                    rows="5">{{$setting->address}}</textarea>
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

@endsection

@section('script')
<script type="text/javascript">
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
</script>
@endsection

<style></style>