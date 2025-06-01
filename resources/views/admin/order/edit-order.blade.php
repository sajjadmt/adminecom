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
                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
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
                                    <form method="POST" action="{{ route('panel.update.order') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-10">
                                                    Order Number: <span style="font-size: 20px">{{ $order->order_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-10">
                                                    Transaction Id: <span style="font-size: 20px">{{ $order->transaction_id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-10">
                                                    User Name: <span style="font-size: 20px">{{ ucfirst($order->user->name) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-3">Order List</h6>
                                                </div>
                                                <div class="row">
                                                    <div>
                                                        @foreach($order->orderList as $item)
                                                            <div class="card">
                                                                <div class="m-3">
                                                                    <div class="col-sm-10">
                                                                        {{ $item->variant->product->title }}
                                                                    </div>
                                                                </div>
                                                                <div class="m-3 mt-0">
                                                                    <div class="col-sm-10">
                                                                        Material: {{ $item->variant->material ? $item->variant->material->title : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="m-3 mt-0">
                                                                    <div class="col-sm-10">
                                                                        Color: {{ $item->variant->color ? $item->variant->color->color_name : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="m-3 mt-0">
                                                                    <div class="col-sm-10">
                                                                        Size: {{ $item->variant->size ? $item->variant->size->size : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="m-3 mt-0">
                                                                    <div class="col-sm-10">
                                                                        Quantity: {{ $item->quantity }}
                                                                    </div>
                                                                </div>
                                                                <div class="m-3 mt-0">
                                                                    <div class="col-sm-10">
                                                                        Discount: {{ $item->variant->discount ? $item->variant->discount . '%' : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="m-3 mt-0">
                                                                    <div class="col-sm-10">
                                                                        Price: ${{ $item->variant->price }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="m-3 mt-0">
                                                    <div class="col-sm-10">
                                                        <h5>Total Price: {{ $order->total_price }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-3">Note</h6>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="col-sm-9 text-secondary">
                                                    <textarea name="note" cols="74" rows="3">{{ $order->note }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-3">Payment Rule</h6>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <select required name="payment_rule" id="payment-select"
                                                        class="form-select form-select-sm mt-1">
                                                    @foreach($rules as $rule)
                                                        <option
                                                            value="{{ $rule->id }}" {{ $order->payment_rule_id === $rule->id ? 'selected' : '' }}>
                                                            {{ ucwords(str_replace('_', ' ', $rule->rule)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                                        value="pending" {{ $order->status == "pending" ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option
                                                        value="processing" {{ $order->status == "processing" ? 'selected' : '' }}>
                                                        Processing
                                                    </option>
                                                    <option
                                                        value="completed" {{ $order->status == "completed" ? 'selected' : '' }}>
                                                        Completed
                                                    </option>
                                                    <option
                                                        value="cancelled" {{ $order->status == "cancelled" ? 'selected' : '' }}>
                                                        Cancelled
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            <input type="submit" class="btn btn-info px-4 text-white"
                                                   value="Update Order"/>
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
