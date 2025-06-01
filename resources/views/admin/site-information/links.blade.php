@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Links</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Edit Links</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card">
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">
                                            {{ $error }}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endforeach
                                    <form method="POST" action="{{ route('panel.update.links') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3"><i class='bx bxl-android'></i> Android App Link</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="android_app_link" class="form-control me-2" type="text" value="{{ $info->android_app_link }}"
                                                           required>
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3"><i class='bx bxl-apple'></i> IOS App Link</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="ios_app_link" class="form-control me-2" type="text" value="{{ $info->ios_app_link }}"
                                                           required>
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3"><i class='bx bxl-facebook-circle'></i> Facebook Link</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="facebook_link" class="form-control me-2" type="text" value="{{ $info->facebook_link }}"
                                                           required>
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3"><i class='bx bxl-instagram-alt'></i> Instagram Link</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="instagram_link" class="form-control me-2" type="text" value="{{ $info->instagram_link }}"
                                                           required>
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3"><i class='bx bxl-telegram'></i> Telegram Link</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="telegram_link" class="form-control me-2" type="text" value="{{ $info->telegram_link }}"
                                                           required>
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3"><i class='bx bxl-twitter'></i> Twitter Link</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="twitter_link" class="form-control me-2" type="text" value="{{ $info->twitter_link }}"
                                                           required>
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3"><i class='bx bx-copyright'></i> Copyright</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="copyright" class="form-control me-2" type="text" value="{{ $info->copyright }}"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Update Links"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
