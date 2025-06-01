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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card radius-10">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h5 class="mb-0">All Product List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control" placeholder="Search Product ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Image</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th class="text-center">Variants</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="product-table-body">
                                                @php($i = 1)
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td class="text-center">
                                                            <div style="justify-content: center"
                                                                 class="d-flex align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="recent-products-img">
                                                                        <a class="image-btn" style="color: black"
                                                                           href="javascript:void(0);"
                                                                           class="text-decoration-none"
                                                                           data-image="{{ $product->images[0]->url }}"><img
                                                                                src="{{ $product->images[0]->url }}"
                                                                                title="{{ $product->title }}"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-left">
                                                            <a class="details-btn" style="color: black"
                                                               href="javascript:void(0);" class="text-decoration-none"
                                                               data-url="{{ route('panel.product.detail', $product->id) }}">{{ Str::limit($product->title, 40, ' ...') }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $product->category->category_name }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                    class="variants-btn"
                                                                    href="javascript:void(0);"
                                                                    data-url="{{ route('panel.product.variants',$product->id) }}"><i
                                                                        class="bx bx-detail"></i></a>
                                                                <a href="{{ route('panel.create.variant',$product->id) }}" class="ms-4"><i
                                                                        class="bx bx-add-to-queue"></i></a>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                    href="{{ route('panel.edit.product',$product->id) }}"><i
                                                                        class="bx bx-edit"></i></a>
                                                                <a href="{{ route('panel.delete.product',$product->id) }}"
                                                                   id="delete" class="ms-4"><i
                                                                        class="bx bx-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('panel.product.search') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        $('#product-table-body').html(data);
                    }
                });
            });
        });
    </script>

@endsection
