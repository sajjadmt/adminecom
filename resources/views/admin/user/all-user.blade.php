@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All User</li>
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
                                                <h5 class="mb-0">All User List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control"
                                                   placeholder="Search User ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0 text-center">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="user-table-body">
                                                @php($i = 1)
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <!--User Avatar-->
                                                        <td class="text-center">
                                                            <div style="justify-content: center"
                                                                 class="d-flex align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="recent-products-img">
                                                                        <img
                                                                            src="{{ asset($user->profile_photo_path) }}"
                                                                            title="{{ $user->name }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!--User Name-->
                                                        <td class="text-center">
                                                            {{ ucfirst($user->name) }}
                                                        </td>
                                                        <!--User Role-->
                                                        <td class="text-center">
                                                            {{ ucfirst($user->role) }}
                                                        </td>
                                                        <!--User Status-->
                                                        <td class="text-center">
                                                            @can('change-status')
                                                                <span class="user-status"
                                                                      style="cursor: pointer; color:black"
                                                                      data-id="{{ $user->id }}"
                                                                      data-name="{{ $user->name }}">
                                                                {{ ucfirst($user->status) }}
                                                                </span>
                                                            @else
                                                                <span style="pointer-events: none; color:dimgray">
                                                                {{ ucfirst($user->status) }}
                                                                </span>
                                                            @endcan
                                                        </td>
                                                        <!--User Actions-->
                                                        <td class="text-center">
                                                            <div class="d-flex order-actions justify-content-center">
                                                                @can('edit-user')
                                                                    <a title="Edit"
                                                                       href="{{ route('panel.edit.user',$user->id) }}"><i
                                                                            class="bx bx-edit"></i></a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                       class="ms-4 disabled-edit"
                                                                       style="pointer-events: none; opacity: 0.5;">
                                                                        <i class="bx bx-edit"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('change-user-password')
                                                                    <a title="Change Password"
                                                                       href="javascript:void(0);"
                                                                       class="ms-4 change-password-btn">
                                                                        <i class="bx bx-lock"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                       class="ms-4 disabled-lock"
                                                                       style="pointer-events: none; opacity: 0.5;">
                                                                        <i class="bx bx-lock"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('delete-user')
                                                                    <a title="Delete"
                                                                       href="{{ route('panel.delete.user', $user->id) }}"
                                                                       id="delete" class="ms-4">
                                                                        <i class="bx bx-trash"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                       class="ms-4 disabled-delete"
                                                                       style="pointer-events: none; opacity: 0.5;">
                                                                        <i class="bx bx-trash"></i>
                                                                    </a>
                                                                @endcan
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
            $('.user-status').click(function () {
                let el = $(this);
                let id = el.data('id');

                $.ajax({
                    url: '{{ route('panel.user.toggle.status') }}',
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
                    url: "{{ route('panel.user.search') }}",
                    type: 'GET',
                    data: {query: query},
                    success: function (data) {
                        $('#user-table-body').html(data);
                    }
                });
            });
        });
    </script>
@endsection
