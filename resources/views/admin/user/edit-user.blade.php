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
                            <li class="breadcrumb-item"><a href="{{ route('panel.users') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                                <form method="POST" action="{{ route('panel.update.user') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" id="user-id" value="{{ $user->id }}">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-3">Role</h6>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <select required name="role" id="role-select"
                                                        class="form-select form-select-sm mt-1">
                                                    <option
                                                        value="customer" {{ $user->role == "customer" ? 'selected' : '' }}>
                                                        Customer
                                                    </option>
                                                    <option
                                                        value="moderator" {{ $user->role == "moderator" ? 'selected' : '' }}>
                                                        Moderator
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Name</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="name" value="{{ $user->name }}"
                                                           class="form-control me-2" type="text"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Email</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="email" value="{{ $user->email }}"
                                                           class="form-control me-2" type="text"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-3">Addresses <i id="add-address" class="bx bx-add-to-queue btn btn-sm add-address-btn" data-id="{{ $user->id }}"></i></h6>
                                                    </div>
                                                    @foreach($user->addresses as $index => $address)
                                                        <input name="addresses[{{ $index }}][id]" type="hidden" value="{{ $address->id }}">
                                                        <div class="card">
                                                            <div class="m-3">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-3">Address <a title="Delete" class="text-dark"
                                                                                                href="{{ route('panel.delete.address', $address->id) }}"
                                                                                                id="delete">
                                                                            <i class="bx bx-trash text-dark"></i>
                                                                        </a></h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input name="addresses[{{ $index }}][address]" placeholder="Address" value="{{ $address->address }}"
                                                                           class="form-control me-2" type="text"
                                                                           required>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-3">State</h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <select name="addresses[{{ $index }}][state_id]" class="form-select me-2 state-select" required>
                                                                        @foreach($states as $state)
                                                                            <option value="{{ $state['id'] }}"
                                                                                {{ isset($address->state_id) && $address->state_id == $state['id'] ? 'selected' : '' }}>
                                                                                {{ $state['name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-3">City</h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <select name="addresses[{{ $index }}][city_id]" class="form-select me-2 city-select" required>
                                                                        @foreach($cities as $city)
                                                                            <option value="{{ $city['id'] }}"
                                                                                {{ isset($address->city_id) && $address->city_id == $city['id'] ? 'selected' : '' }}>
                                                                                {{ $city['name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3 mt-3">
                                                                    <h6 class="mb-3">Postal Code</h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input name="addresses[{{ $index }}][postal_code]" placeholder="Postal Code" value="{{ $address->postal_code }}"
                                                                           class="form-control me-2" type="text"
                                                                           required>
                                                                </div>
                                                                <div class="col-sm-3 mt-3">
                                                                    <h6 class="mb-3">No</h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input name="addresses[{{ $index }}][no]" placeholder="No" value="{{ $address->no }}"
                                                                           class="form-control me-2" type="number">
                                                                </div>
                                                                <div class="col-sm-3 mt-3">
                                                                    <h6 class="mb-3">Mobile</h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input name="addresses[{{ $index }}][mobile]" placeholder="Mobile" value="{{ $address->mobile }}"
                                                                           class="form-control me-2" type="text"
                                                                           required>
                                                                </div>
                                                                <div class="col-sm-3 mt-3">
                                                                    <h6 class="mb-3">Recipient Name</h6>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input name="addresses[{{ $index }}][recipient_name]" placeholder="Recipient Name" value="{{ $address->recipient_name }}"
                                                                           class="form-control me-2" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-3">Status</h6>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <select required name="status" id="status-select"
                                                        class="form-select form-select-sm mt-1">
                                                    <option
                                                        value="">
                                                        Select Status
                                                    </option>
                                                    <option
                                                        value="active" {{ $user->status == "active" ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option
                                                        value="inactive" {{ $user->status == "inactive" ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center mt-3">
                                                <input name="profile_photo_path" class="form-control me-2" type="file"
                                                       id="image">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <img alt="Category Image" src="{{ $user->profile_photo_path }}"
                                                 style="width: auto; height: 150px"
                                                 id="imagePreview">
                                        </div>
                                        <div class="text-secondary mt-3">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Update User"/>
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
    </script>

@endsection
