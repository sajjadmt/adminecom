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
                            <li class="breadcrumb-item"><a href="{{ route('panel.reviews') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Review</li>
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
                                    <form method="POST" action="{{ route('panel.update.review') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $review->id }}">
                                    <div class="card-body">
                                        <div class="row mb-1">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Author: {{ ucfirst($review->user->name) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-10">
                                                    <h6 class="mb-3">For: {{ ucfirst($review->product->title) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-3">Rating</h6>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <select required name="rating"
                                                        class="form-select form-select-sm mt-1 rating-select">
                                                    <option
                                                        value="">
                                                        Select Rating
                                                    </option>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Comment</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <textarea name="comment" class="form-control me-2"
                                                              required>{{ $review->comment }}</textarea>
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
                                                        value="approved" {{ $review->status == "approved" ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option
                                                        value="rejected" {{ $review->status == "rejected" ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Update Review"/>
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
