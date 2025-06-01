@php use Illuminate\Support\Str; @endphp
@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Notification</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Notification</li>
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
                                                <h5 class="mb-0">All Notification List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control"
                                                   placeholder="Search Notification ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Title</th>
                                                    <th>Message</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="notification-table-body">
                                                @php($i = 1)
                                                @foreach ($notifications as $notification)
                                                    <tr class="{{ $notification->status == 'unread' ? 'text-black' : 'text-secondary' }}">
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            <img src="{{ $notification->user->profile_photo_path }}" class="user-img" alt="user avatar"> {{ $notification->user->name }}
                                                        </td>
                                                        <td>
                                                            <a
                                                                class="show-notification text-decoration-none {{ $notification->status == 'unread' ? 'text-black' : 'text-secondary' }}"
                                                                href="javascript:void(0);"
                                                                data-url="{{ route('panel.notification.show', $notification->id) }}"
                                                            >
                                                                {{ Str::limit($notification->title, 20, '...') }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                class="show-notification text-decoration-none {{ $notification->status == 'unread' ? 'text-black' : 'text-secondary' }}"
                                                                href="javascript:void(0);"
                                                                data-url="{{ route('panel.notification.show', $notification->id) }}"
                                                            >
                                                                {{ Str::limit($notification->message, 30, '...') }}
                                                            </a>

                                                        </td>
                                                        <td>
                                                            <span class="notification-status"
                                                                  style="cursor: pointer;"
                                                                  data-id="{{ $notification->id }}">
                                                                {{ ucfirst($notification->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex order-actions justify-content-center">
                                                                <a href="{{ route('panel.delete.notification',$notification->id) }}"
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
            $('.notification-status').click(function () {
                let el = $(this);
                let id = el.data('id');

                $.ajax({
                    url: '{{ route('panel.notification.toggle.status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (res) {
                        el.text(res.status);
                        let row = el.closest('tr');
                        row.removeClass('text-black text-secondary');
                        let link = row.find('a.show-notification');
                        link.removeClass('text-black text-secondary');
                        if (res.status === 'unread') {
                            row.addClass('text-black');
                            link.addClass('text-black');
                        } else {
                            row.addClass('text-secondary');
                            link.addClass('text-secondary');
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
                    url: "{{ route('panel.notification.search') }}",
                    type: 'GET',
                    data: {query: query},
                    success: function (data) {
                        $('#notification-table-body').html(data);
                    }
                });
            });
        });
    </script>
@endsection
