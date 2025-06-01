@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Category</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('panel.categories') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                                    <form method="POST" action="{{ route('panel.update.category') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Category Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required type="text" value="{{ $category->category_name }}"
                                                       name="category_name" class="form-control"/>
                                            </div>
                                            @if($category->parent_id !== null)
                                                <div class="mt-3">
                                                    <div>
                                                        <nav aria-label="breadcrumb">
                                                            <ol class="breadcrumb mb-0 p-0">
                                                                Current Category Path: &nbsp <u>
                                                                    <li class="breadcrumb-item active text-success" aria-current="page">
                                                                        {{ $categoryPath }}
                                                                    </li>
                                                                </u>
                                                            </ol>
                                                        </nav>
                                                        <br>
                                                    </div>
                                                    <input type="checkbox" id="enable_category_transfer"
                                                           name="enable_category_transfer">
                                                    <label for="enable_category_transfer">Select New Main
                                                        Category</label>
                                                </div>

                                                <div class="mt-3" id="category_transfer_section" style="display: none;">
                                                    <select class="form-control" id="new_category_id"
                                                            name="new_category_id" disabled>
                                                        <option value="">Select New Main Category</option>
                                                        @foreach($categories as $category)
                                                            @include('admin.category.category-options', ['category' => $category, 'level' => 0])
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            <div>
                                                <div class="d-flex align-items-center mt-3">
                                                    <input name="category_image" class="form-control me-2" type="file"
                                                           id="image">
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <img alt="Category Image" src="{{ $category->category_image }}" style="width: auto; height: 150px"
                                                     id="imagePreview">
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Update Category"/>
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
        document.addEventListener("DOMContentLoaded", function () {
            let checkbox = document.getElementById("enable_category_transfer");
            let categoryTransferSection = document.getElementById("category_transfer_section");
            let newCategorySelect = document.getElementById("new_category_id");

            checkbox.addEventListener("change", function () {
                if (this.checked) {
                    categoryTransferSection.style.display = "block";
                    newCategorySelect.removeAttribute("disabled");
                } else {
                    categoryTransferSection.style.display = "none";
                    newCategorySelect.setAttribute("disabled", "true");
                    newCategorySelect.value = "";
                }
            });
        });
    </script>

@endsection
