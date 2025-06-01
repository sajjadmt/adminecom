@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Specification</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Specification</li>
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
                                                <h5 class="mb-0">All Specification List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control"
                                                   placeholder="Search Specification ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0 text-center">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Attributes</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="specification-table-body">
                                                @php($i = 1)
                                                @foreach ($specifications as $specification)
                                                    <tr>
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td class="text-center">
                                                            {{ $specification->title }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="spec-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $specification->id }}">
                                                                {{ $specification->status }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                    class="attributes-btn"
                                                                    href="javascript:void(0);"
                                                                    data-url="{{ route('panel.specification.attributes',$specification->id) }}"><i
                                                                        class="bx bx-detail"></i></a>
                                                                <a href="{{ route('panel.create.attribute',$specification->id) }}" class="ms-4"><i
                                                                        class="bx bx-add-to-queue"></i></a>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                    href="{{ route('panel.edit.specification',$specification->id) }}"><i
                                                                        class="bx bx-edit"></i></a>
                                                                <a href="{{ route('panel.delete.specification',$specification->id) }}"
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
            $('.spec-status').click(function () {
                let el = $(this);
                let id = el.data('id');

                $.ajax({
                    url: '{{ route('panel.specification.toggle.status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (res) {
                        el.text(res.status);
                    },
                    error: function () {
                        alert('Something Wrong');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                let query = $(this).val();
                $.ajax({
                    url: "{{ route('panel.specification.search') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        $('#specification-table-body').html(data);
                    }
                });
            });
        });
    </script>
@endsection
