@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Attribute</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('panel.attributes') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New Attribute</li>
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
                                <form method="POST" action="{{ route('panel.store.attribute') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $specification->id }}">
                                    <div class="card-body">
                                                <h5>Create Attribute For "<u>{{ $specification->title }}</u>"</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Title</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <input name="title" class="form-control me-2" type="text"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
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
                                                        value="active">
                                                        Active
                                                    </option>
                                                    <option
                                                        value="inactive">
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Create Attribute"/>
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
@endsection
