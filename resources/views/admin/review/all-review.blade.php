@php use Illuminate\Support\Str; @endphp
@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Review</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Review</li>
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
                                                <h5 class="mb-0">All Review List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control"
                                                   placeholder="Search Review ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0 text-center">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Product</th>
                                                    <th>Comment</th>
                                                    <th>Rating</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="review-table-body">
                                                @php($i = 1)
                                                @foreach ($reviews as $review)
                                                    <tr class="{{ $review->status == 'approved' ? 'text-black' : 'text-secondary' }}">
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td class="text-center">
                                                            {{ $review->user->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ Str::limit($review->product->title, 20, '...') }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ Str::limit($review->comment, 30, '...') }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $review->rating }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="review-status"
                                                                  style="cursor: pointer;"
                                                                  data-id="{{ $review->id }}">
                                                                {{ ucfirst($review->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                        href="{{ route('panel.edit.review',$review->id) }}"><i
                                                                            class="bx bx-edit"></i></a>
                                                                <a href="{{ route('panel.delete.review',$review->id) }}"
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
            $('.review-status').click(function () {
                let el = $(this);
                let id = el.data('id');

                $.ajax({
                    url: '{{ route('panel.review.toggle.status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (res) {
                        el.text(res.status);
                        let row = el.closest('tr');
                        row.removeClass('text-black text-secondary');
                        if (res.status === 'approved') {
                            row.addClass('text-black');
                        } else {
                            row.addClass('text-secondary');
                        }
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
                    url: "{{ route('panel.review.search') }}",
                    type: 'GET',
                    data: {query: query},
                    success: function (data) {
                        $('#review-table-body').html(data);
                    }
                });
            });
        });
    </script>
@endsection
