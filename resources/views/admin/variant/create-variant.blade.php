@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Variant</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('panel.products') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Create Variant</li>
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
                                <form method="POST" action="{{ route('panel.store.variant') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-auto">
                                                <img style="height: 150px; width: auto;border-radius: 10px"
                                                     src="{{ $product->images[0]->url }}" alt="">
                                            </div>
                                            <div class="col" style="margin-top: 3.5rem">
                                                <h4 class="mb-0">{{ $product->title }}</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Color</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select required name="color_id" id="color-select"
                                                        class="form-select form-select-sm mt-1">
                                                    <option value="">Select Color</option>
                                                    @foreach($colors as $color)
                                                        <option
                                                            value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Size</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select name="size_id" id="size-select"
                                                        class="form-select form-select-sm mt-1">
                                                    <option value="">Select Size</option>
                                                    @foreach($sizes as $size)
                                                        <option
                                                            value="{{ $size->id }}">{{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Material</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select name="material_id" id="material-select"
                                                        class="form-select form-select-sm mt-1">
                                                    <option value="">Select Material</option>
                                                    @foreach($materials as $material)
                                                        <option
                                                            value="{{ $material->id }}">{{ $material->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Price</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required placeholder="Price" type="number" name="price" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Discount</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input placeholder="Discount" type="number" name="discount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Stock</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input required placeholder="Stock" type="number" name="stock" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Star</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input placeholder="Star" type="number" name="star" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Status</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select required name="status" id="status-select"
                                                        class="form-select form-select-sm mt-1">
                                                    <option
                                                        value="">
                                                        Select Status
                                                    </option>
                                                    <option
                                                        value="active">
                                                        Active
                                                    </option>
                                                    <option
                                                        value="inactive">
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Create Variant"/>
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
