@php use Illuminate\Support\Str; @endphp
@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Order</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cancelled Order</li>
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
                                                <h5 class="mb-0">Cancelled Order List</h5>
                                            </div>
                                            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>Order No</th>
                                                    <th>User</th>
                                                    <th>Payment Status</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="order-table-body">
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->order_no }}</td>
                                                        <td>
                                                            <img class="user-img"
                                                                 src="{{ $order->user->profile_photo_path }}"
                                                                 alt=""> {{ ucfirst($order->user->name) }}
                                                        </td>
                                                        <td class="{{ $order->payment_status === 'paid' ? 'text-success' : 'text-danger' }}">
                                                            {{ ucfirst($order->payment_status) }}
                                                        </td>
                                                        <td>
                                                            {{ $order->total_price }}
                                                        </td>
                                                        <td class="text-danger">{{ ucfirst($order->status) }}</td>
                                                        <td>
                                                            {{ $order->created_at }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex order-actions justify-content-center"><a
                                                                    href="{{ route('panel.edit.order',$order->id) }}"><i
                                                                        class="bx bx-edit"></i></a>
                                                                <a href="{{ route('panel.delete.order',$order->id) }}"
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
@endsection
