@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('panel.products') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New Product</li>
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
                                <form method="POST" action="{{ route('panel.store.product') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="mb-3">
                                                <input required type="text" name="title" placeholder="Product Name"
                                                       class="form-control"/>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control"
                                                        name="category_id" id="category-select">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        @include('admin.category.category-options', ['category' => $category, 'level' => 0])
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control"
                                                        name="brand_id" id="brand-select">
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control"
                                                        name="remark" id="remark-select">
                                                    <option value="">Select Remark</option>
                                                    <option value="new">New</option>
                                                    <option value="sale">Sale</option>
                                                    <option value="featured">Featured</option>
                                                    <option value="out_of_stock">Out Of Stock</option>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <div>
                                                    Specifications
                                                </div>
                                                <div class="row">
                                                    @foreach($specifications as $specification)
                                                        <div class="mt-3 col-md-6">
                                                            <div class="border p-2 rounded">
                                                                <input type="hidden" name="specifications[{{ $specification->id }}][selected]" value="0">
                                                                <input type="checkbox" name="specifications[{{ $specification->id }}][selected]" class="form-check-input me-2 specification-checkbox" data-spec-id="{{ $specification->id }}" value="1">
                                                                <strong>{{ $specification->title }}</strong>
                                                                <br>
                                                                @foreach($specification->attributes as $attribute)
                                                                    <div class="mt-2 ms-4">
                                                                        <div class="row align-items-center spec-fields" data-spec-id="{{ $specification->id }}">
                                                                            <div class="col-md-6">
                                                                                <label class="form-label small text-muted">{{ $attribute->title }}</label>
                                                                                <input name="specifications[{{ $specification->id }}][attributes][{{ $attribute->id }}][value]" type="text" class="form-control form-control-sm mt-1" disabled>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label small text-muted">&nbsp</label>
                                                                                <select name="specifications[{{ $specification->id }}][attributes][{{ $attribute->id }}][unit_id]" class="form-select form-select-sm mt-1 unit-select" disabled>
                                                                                    <option value="">Select Unit</option>
                                                                                    @foreach($units as $unit)
                                                                                        <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <textarea name="short_description" placeholder="Short Description"
                                                          class="form-control"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <textarea name="long_description" placeholder="Long Description"
                                                          class="form-control"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="weight" placeholder="Weight(Gram)"
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="length" placeholder="Length(Centimeter)"
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="width" placeholder="Width(Centimeter)"
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="height" placeholder="Height(Centimeter)"
                                                       class="form-control">
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                Product Images
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <input name="images[]" class="form-control me-2" type="file"
                                                           required multiple
                                                           id="image">
                                                </div>
                                            </div>
                                            <div class="mt-2 d-flex flex-wrap gap-2" id="imagePreviewContainer">
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.querySelector('input[name="images[]"]');
            const previewContainer = document.getElementById('imagePreviewContainer');

            imageInput.addEventListener('change', function () {
                previewContainer.innerHTML = ''; // Clear old previews

                Array.from(this.files).forEach(file => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.height = '150px';
                        img.style.marginRight = '10px';
                        img.style.objectFit = 'cover';
                        img.style.border = '1px solid #ccc';
                        img.style.borderRadius = '8px';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

@endsection
