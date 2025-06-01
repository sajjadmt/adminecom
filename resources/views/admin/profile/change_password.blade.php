@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <form method="POST" action="{{ route('user.profile.updatePassword') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                <div class="text-white">
                                                    {{ $error }}
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endforeach
                                        <div class="row mb-3">
                                            <div class="col-sm-3 mt-2">
                                                <h6 class="mb-0">Current Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required type="password" name="current_password" id="current_password" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 mt-2">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required type="password" name="password" id="password" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 mt-2">
                                                <h6 class="mb-0">Password Confirmation</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white" value="Change Password"/>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (event) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $('#imagePreview').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files['0']);
            });
        });
    </script>

@endsection
