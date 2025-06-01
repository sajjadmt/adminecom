@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Color</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Color</li>
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
                                                <h5 class="mb-0">All Color List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control"
                                                   placeholder="Search Color ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0 text-center">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="color-table-body">
                                                @php($i = 1)
                                                @foreach ($colors as $color)
                                                    <tr>
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td class="text-center">
                                                            {{ $color->color_name }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="color-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $color->id }}">
                                                                {{ $color->status }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                    href="{{ route('panel.edit.color',$color->id) }}"><i
                                                                        class="bx bx-edit"></i></a>
                                                                <a href="{{ route('panel.delete.color',$color->id) }}"
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
            $('.color-status').click(function () {
                let el = $(this);
                let id = el.data('id');

                $.ajax({
                    url: '{{ route('panel.color.toggle.status') }}',
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
        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                let query = $(this).val();
                $.ajax({
                    url: "{{ route('panel.color.search') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        $('#color-table-body').html(data);
                    }
                });
            });
        });
    </script>
@endsection
