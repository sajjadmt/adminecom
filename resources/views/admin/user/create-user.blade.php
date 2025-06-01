@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('panel.users') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New User</li>
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
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">
                                            {{ $error }}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endforeach
                                <form method="POST" action="{{ route('panel.store.user') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="col-sm-3 mt-3">
                                                <h6 class="mb-3">Role</h6>
                                            </div>
                                            <select required class="form-control" id="role-select" name="role">
                                                <option value="customer">Customer</option>
                                                <option value="moderator">Moderator</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-3 mt-3">
                                                <h6 class="mb-3">Name</h6>
                                            </div>
                                            <input required value="{{ old('name') }}" type="text" name="name" placeholder="Name"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-3 mt-3">
                                                <h6 class="mb-3">Email</h6>
                                            </div>
                                            <input required type="email" value="{{ old('email') }}" name="email" placeholder="Email"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-3 mt-3">
                                                <h6 class="mb-3">Password</h6>
                                            </div>
                                            <input required type="password" name="password" placeholder="Password"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-3 mt-3">
                                                <h6 class="mb-3">Password Confirmation</h6>
                                            </div>
                                            <input required type="password" name="password_confirmation" placeholder="Password Confirmation"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-3 mt-3">
                                                <h6 class="mb-3">Status</h6>
                                            </div>
                                            <select required class="form-control" id="status-select" name="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">User Avatar</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="profile_photo_path" class="form-control me-2" type="file"
                                                           id="image">
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <img alt="Category Image" style="width: auto; height: 150px"
                                                     id="imagePreview">
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Create User"/>
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
