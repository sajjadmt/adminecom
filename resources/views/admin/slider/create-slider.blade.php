@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Slider</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('panel.sliders') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New Slider</li>
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
                                <form method="POST" action="{{ route('panel.store.slider') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Slider Image</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="slider_image" class="form-control me-2" type="file"
                                                           required
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
                                                   value="Create Slider"/>
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
