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
                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                                <form method="POST" action="{{ route('panel.update.product') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="mb-3">
                                                <input required type="text" name="title" placeholder="Product Name"
                                                       value="{{ $product->title }}"
                                                       class="form-control"/>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control"
                                                        name="category_id" id="category-select">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        @include('admin.product.category-options', ['category' => $category, 'level' => 0])
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control"
                                                        name="brand_id" id="brand-select">
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                        <option
                                                            value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control"
                                                        name="remark" id="remark-select">
                                                    <option value="">Select Remark</option>
                                                    <option
                                                        value="new" {{ $product->remark == "new" ? 'selected' : '' }}>
                                                        New
                                                    </option>
                                                    <option
                                                        value="sale" {{ $product->remark == "sale" ? 'selected' : '' }}>
                                                        Sale
                                                    </option>
                                                    <option
                                                        value="featured" {{ $product->remark == "featured" ? 'selected' : '' }}>
                                                        Featured
                                                    </option>
                                                    <option
                                                        value="out_of_stock" {{ $product->remark == "out_of_stock" ? 'selected' : '' }}>
                                                        Out Of Stock
                                                    </option>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <div>
                                                    Specifications
                                                </div>
                                                <div class="row">
                                                    @foreach($specifications as $specification)
                                                        @php
                                                            $productSpec = $product->specifications->firstWhere('id', $specification->id);
                                                        @endphp
                                                        <div class="mt-3 col-md-6">
                                                            <div class="border p-2 rounded">
                                                                <input type="hidden"
                                                                       name="specifications[{{ $specification->id }}][selected]"
                                                                       value="0">
                                                                <input type="checkbox"
                                                                       {{ $productSpec ? 'checked' : '' }} name="specifications[{{ $specification->id }}][selected]"
                                                                       class="form-check-input me-2 specification-checkbox"
                                                                       data-spec-id="{{ $specification->id }}"
                                                                       value="1">
                                                                <strong>{{ $specification->title }}</strong>
                                                                <br>
                                                                @foreach($specification->attributes as $attribute)
                                                                    <div class="mt-2 ms-4">
                                                                        <div class="row align-items-center spec-fields"
                                                                             data-spec-id="{{ $specification->id }}">
                                                                            <div class="col-md-6">
                                                                                <label
                                                                                    class="form-label small text-muted">{{ $attribute->title }}</label>
                                                                                <input
                                                                                    value="{{ optional($productSpec?->attributes->firstWhere('id', $attribute->id)?->values->first())->value ?? '' }}"
                                                                                    name="specifications[{{ $specification->id }}][attributes][{{ $attribute->id }}][value]"
                                                                                    type="text"
                                                                                    class="form-control form-control-sm mt-1" {{ $productSpec ? '' : 'disabled' }}>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label
                                                                                    class="form-label small text-muted">&nbsp</label>
                                                                                <select
                                                                                    name="specifications[{{ $specification->id }}][attributes][{{ $attribute->id }}][unit_id]"
                                                                                    class="form-select form-select-sm mt-1 unit-select" {{ $productSpec ? '' : 'disabled' }}>
                                                                                    <option value="">Select Unit
                                                                                    </option>
                                                                                    @foreach($units as $unit)
                                                                                        <option
                                                                                            value="{{ $unit->id }}" {{ optional($productSpec?->attributes->firstWhere('id', $attribute->id)?->values->first())->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->title }}</option>
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
                                                          class="form-control">{{ $product->short_description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <textarea name="long_description" placeholder="Long Description"
                                                          class="form-control">{{ $product->long_description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="weight" value="{{ $product->weight }}"
                                                       placeholder="Weight(Gram)"
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="length" value="{{ $product->length }}"
                                                       placeholder="Length(Centimeter)"
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="width" value="{{ $product->width }}"
                                                       placeholder="Width(Centimeter)"
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" name="height" value="{{ $product->height }}"
                                                       placeholder="Height(Centimeter)"
                                                       class="form-control">
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                Product Images
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <input name="images[]" class="form-control me-2" type="file"
                                                           multiple
                                                           id="image">
                                                </div>
                                            </div>
                                            <div class="mt-2 d-flex flex-wrap gap-2" id="imagePreviewContainer">
                                            </div>
                                            <div class="mt-3" id="existing-images">
                                                <div class="d-flex flex-wrap gap-2">
                                                    @php $imagesName = []; @endphp
                                                    @foreach($product->images as $image)
                                                        @php $imagesName[] = basename($image->url) @endphp
                                                        <div class="position-relative" style="width: 120px">
                                                            <img src="{{ $image->url }}" class="img-thumbnail"
                                                                 width="100%">
                                                            <i class="btn bx bx-trash btn-sm btn-danger position-absolute top-0 end-0 delete-image-btn"
                                                               data-id="{{ $image->id }}" style="z-index: 2"></i>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <input type="hidden" name="remaining_images" id="remaining_images"
                                                   value='@json($imagesName)'>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.querySelector('input[name="images[]"]');
            const previewContainer = document.getElementById('imagePreviewContainer');

            let selectedFiles = [];

            imageInput.addEventListener('change', function () {
                previewContainer.innerHTML = '';
                selectedFiles = Array.from(this.files);

                selectedFiles.forEach((file, index) => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'position-relative';
                        wrapper.style.width = '120px';
                        wrapper.style.marginRight = '10px';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail';
                        img.style.height = '150px';
                        img.style.objectFit = 'cover';
                        img.style.border = '1px solid #ccc';
                        img.style.borderRadius = '8px';
                        img.style.width = '100%';

                        const deleteBtn = document.createElement('i');
                        deleteBtn.className = 'btn bx bx-trash btn-sm btn-danger position-absolute top-0 end-0';
                        deleteBtn.style.zIndex = '2';
                        deleteBtn.style.cursor = 'pointer';

                        deleteBtn.addEventListener('click', function () {
                            selectedFiles.splice(index, 1);
                            updateFileInput();
                            wrapper.remove();
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(deleteBtn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });

                updateFileInput();
            });

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                imageInput.files = dataTransfer.files;
            }
        });
        let imagesName = @json($imagesName);

        $(document).on('click', '.delete-image-btn', function (e) {
            e.preventDefault();
            const $btn = $(this);
            const imageWrapper = $btn.closest('.position-relative');
            const imageUrl = imageWrapper.find('img').attr('src');
            const imageName = imageUrl.split('/').pop();

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Image?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#306ad6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imageWrapper.remove();
                    imagesName = imagesName.filter(name => name !== imageName);
                    $('#remaining_images').val(JSON.stringify(imagesName));
                }
            });
        });
    </script>

@endsection
