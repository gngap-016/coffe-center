@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
              <div class="col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Setting Toko</span>
                   
                </div>
                @foreach ($settings as $setting)
                <div class="card-body">
                    <table class="table">
                    <tr>    
                        <td>Logo</td> 
                    <td>
                           
                            <img src="images/logo.png" class="img-thumbnail" width="40px"
                                alt="{{ $setting->name }}">
                            
                        </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{ $setting->name }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $setting->address }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{ $setting->instagram }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{ $setting->facebook }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $setting->email }}</td>
                        </tr>
                        <tr>
                            <td>Whatsapp</td>
                            <td>{{ $setting->whatsapp }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $setting->phone }}</td>
                        </tr>
                       
                    </table>
                    <hr>
                    
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editData{{$setting->id}}">
                                Edit
                            </button>
                @endforeach
                </div>
            </div>
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

@endsection


<style></style>
