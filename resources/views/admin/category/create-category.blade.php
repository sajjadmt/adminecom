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
                            <li class="breadcrumb-item active" aria-current="page">New Category</li>
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
                                <form method="POST" action="{{ route('panel.store.category') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Category Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required type="text" name="category_name" class="form-control"/>
                                            </div>
                                            <div class="mb-3">
                                                <div class="col-sm-3 mt-3">
                                                    <h6 class="mb-3">Category ُType</h6>
                                                </div>
                                                <select class="form-control" id="category_type" name="category_type">
                                                    <option value="main">Main Category</option>
                                                    <option value="sub">Sub Category</option>
                                                </select>
                                            </div>
                                            <div class="mb-3" id="parent_category_section" style="display: none;">
                                                <select class="form-control" id="parent_id" name="parent_id">
                                                    <option value="">Select Main Category</option>
                                                    @foreach($categories as $category)
                                                        @include('admin.category.category-options', ['category' => $category, 'level' => 0])
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <input name="category_image" class="form-control me-2" type="file"
                                                           required
                                                           id="image">
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <img alt="Category Image" style="width: auto; height: 150px"
                                                     id="imagePreview">
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Create Category"/>
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
            let categoryType = document.getElementById("category_type");
            let parentCategorySection = document.getElementById("parent_category_section");

            function toggleParentCategory() {
                if (categoryType.value === "sub") {
                    parentCategorySection.style.display = "block";
                    document.getElementById("parent_id").setAttribute("required", "true");
                } else {
                    parentCategorySection.style.display = "none";
                    document.getElementById("parent_id").removeAttribute("required");
                    document.getElementById("parent_id").value = "";
                }
            }

            categoryType.addEventListener("change", toggleParentCategory);
            toggleParentCategory();
        });
    </script>

@endsection
