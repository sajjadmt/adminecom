@php use App\Models\Category;use App\Models\Order;use App\Models\Product;use App\Models\Review;use App\Models\User;use App\Models\Visitor;use Illuminate\Support\Str; @endphp
@extends('admin.admin_master')
@section('admin')
    @php
        $orders = Order::with('user')->latest()->take(5)->get();
        $reviews = Review::with(['user','product'])->latest()->take(5)->get();
        $products = Product::with(['category','brand','images'])->latest()->take(5)->get();
        $categories = Category::with('parent')->latest()->take(5)->get();
        $users = User::latest()->take(5)->get();
        $totalOrders = $orders->count();
        $totalRevenue = Order::where('status','completed')->sum('total_price');
        $usersCount = User::count();
        $uniqueVisitors = Visitor::distinct('ip_address')->count('ip_address');
    @endphp
    <div class="page-wrapper">
        <div class="page-content">

            {{--            Information--}}
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 bg-gradient-deepblue">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <p class="mb-0"></p> <h5 class="mb-0 text-white">{{ $totalOrders }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-cart fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-gradient-orange">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">${{ $totalRevenue }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-dollar fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Revenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-gradient-ohhappiness">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">{{ $usersCount }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-group fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Users</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-gradient-ibiza">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">{{ $uniqueVisitors }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-user-check fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Unique Visitors</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            End Information--}}

            {{--            Orders--}}
            <div class="row">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="card-header border-bottom bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last Orders</h6>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Order No</th>
                                    <th>User</th>
                                    <th>Payment Status</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_no }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ $order->user->profile_photo_path }}" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ ucfirst($order->user->name) }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ ucfirst($order->payment_status) }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td class="@switch($order->status)
                                        @case('pending')
                                        text-warning
                                        @break
                                        @case('cancelled')
                                        text-danger
                                        @break
                                        @case('processing')
                                        text-info
                                        @break
                                        @case('completed')
                                        text-success
                                        @break
                                        @endswitch">{{ ucfirst($order->status) }}</td>
                                        <td>
                                            {{ $order->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <center class="mt-3"><a class="text-black" href="{{ route('panel.orders') }}">See All Orders
                                    ...</a></center>
                        </div>
                    </div>
                </div>

            </div>
            {{--            End Orders--}}

            {{--            Reviews And Users--}}
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header border-bottom bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last Reviews</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($reviews as $review)
                                <li class="list-group-item bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $review->user->profile_photo_path }}" alt="user avatar"
                                             class="rounded-circle"
                                             width="55" height="55">
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ Str::limit($review->product->title,70) }}</h6>
                                            <p class="mb-0 small-font">{{ ucfirst($review->user->name) }}
                                                : {{ Str::limit($review->comment,65) }}</p>
                                            <small>{{ $review->created_at ? $review->created_at->format('H:i') : '' }}</small>
                                        </div>
                                        <div class="ms-auto star">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class='bx bxs-star text-warning'></i> {{-- ستاره طلایی --}}
                                                @else
                                                    <i class='bx bxs-star text-light-4'></i> {{-- ستاره خاکستری --}}
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <center class="m-3"><a class="text-black" href="{{ route('panel.reviews') }}">See All Reviews
                                ...</a></center>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-header border-bottom bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last Users</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($users as $user)
                                <li class="list-group-item bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->profile_photo_path }}" alt="user avatar"
                                             class="rounded-circle"
                                             width="55" height="55">
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ ucfirst($user->name) }}</h6>
                                            <p class="mb-0 small-font">{{ Str::limit($user->email,20) }}</p>
                                        </div>
                                        <div class="ms-auto star">
                                            <p><small>{{ ucfirst($user->role) }}</small></p>
                                            <small>{{ $user->created_at ? $user->created_at->format('H:i') : '' }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <center class="m-3"><a class="text-black" href="{{ route('panel.users') }}">See All User
                                ...</a></center>
                    </div>
                </div>
            </div>
            {{--            End Reviews And Users--}}

            {{--            Products And Users--}}
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-header border-bottom mt-3 mb-2 bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last Categories</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($categories as $category)
                                <li class="list-group-item bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $category->category_image }}" alt="user avatar"
                                             width="55">
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ ucfirst($category->category_name) }}</h6>
                                            <p class="mb-0 small-font">{{ $category->parent ? ucfirst($category->parent->category_name) : '' }}</p>
                                        </div>
                                        <div class="ms-auto star mt-3">
                                            <small>{{ $category->created_at ? $category->created_at->format('H:i') : '' }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <center class="m-3"><a class="text-black" href="{{ route('panel.categories') }}">See All Category
                                ...</a></center>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-8 d-flex">
                    <div class="card radius-10 w-100">
                            <div class="card-body">
                                <div class="card-header border-bottom bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Last Products</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td><img src="{{ $product->images[0]->url }}" alt="user avatar"
                                                         width="55"> {{ Str::limit($product->title,50) }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-2">
                                                            <h6 class="mb-1 font-14">{{ ucfirst($product->category->category_name) }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ ucfirst($product->brand->brand_name) }}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <center class="mt-3"><a class="text-black" href="{{ route('panel.products') }}">See
                                            All Products
                                            ...</a></center>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            {{--            End Products And Users--}}

        </div>
@endsection
