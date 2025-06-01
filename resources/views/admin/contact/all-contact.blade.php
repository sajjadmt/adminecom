@php use Illuminate\Support\Str; @endphp
@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Contact</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Contact</li>
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
                                                <h5 class="mb-0">All Contact List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" id="search-input" class="form-control"
                                                   placeholder="Search Contact ...">
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="contact-table-body">
                                                @php($i = 1)
                                                @foreach ($contacts as $contact)
                                                    <tr class="{{ $contact->status == 'unread' ? 'text-black' : 'text-secondary' }}">
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            {{ $contact->name }}
                                                        </td>
                                                        <td>
                                                            {{ $contact->email }}
                                                        </td>
                                                        <td>
                                                            <a
                                                                class="show-contact text-decoration-none {{ $contact->status == 'unread' ? 'text-black' : 'text-secondary' }}"
                                                                href="javascript:void(0);"
                                                                data-url="{{ route('panel.contact.show', $contact->id) }}"
                                                            >
                                                                {{ Str::limit($contact->message, 30, '...') }}
                                                            </a>

                                                        </td>
                                                        <td>
                                                            <span class="contact-status"
                                                                  style="cursor: pointer;"
                                                                  data-id="{{ $contact->id }}">
                                                                {{ ucfirst($contact->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex order-actions justify-content-center">
                                                                <a href="{{ route('panel.delete.contact',$contact->id) }}"
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
            $('.contact-status').click(function () {
                let el = $(this);
                let id = el.data('id');

                $.ajax({
                    url: '{{ route('panel.contact.toggle.status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (res) {
                        el.text(res.status);
                        let row = el.closest('tr');
                        row.removeClass('text-black text-secondary');
                        let link = row.find('a.show-contact');
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
                    url: "{{ route('panel.contact.search') }}",
                    type: 'GET',
                    data: {query: query},
                    success: function (data) {
                        $('#contact-table-body').html(data);
                    }
                });
            });
        });
    </script>
@endsection
