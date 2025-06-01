@php use App\Models\Order;use Illuminate\Support\Facades\Session; @endphp
    <!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png"/>
    <!--plugins-->
    <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <!-- loader-->
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dark-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/semi-dark.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/header-colors.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <title>Admin Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('admin.body.sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @php
        use App\Models\Notification;
        use App\Models\Contact;

        $headerNotifications = Notification::where('status','unread')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        $headerNotificationsCount = Notification::where('status','unread')->count();

        $headerContacts = Contact::where('status','unread')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        $headerContactsCount = Contact::where('status','unread')->count();

        $orderCount = Order::count();

    @endphp
    @include('admin.body.header', [
    'notifications' => $headerNotifications,
    'notificationCount' => $headerNotificationsCount,
    'contacts' => $headerContacts,
    'contactCount' => $headerContactsCount,
    ])
    <!--end header -->
    <!--start page wrapper -->
    @yield('admin')
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('admin.body.footer')
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
<script>
    $(function () {
        $(".knob").knob();
    });
</script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
<!--app JS-->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}";
    switch (type) {
        case 'info':
            Swal.fire({
                text: "{{ Session::get('message') }}",
                icon: 'info',
                showConfirmButton: false,
                timer: 2000
            });
            break;
        case 'success':
            Swal.fire({
                text: "{{ Session::get('message') }}",
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
            break;
        case 'warning':
            Swal.fire({
                text: "{{ Session::get('message') }}",
                icon: 'warning',
                showConfirmButton: false,
                timer: 2000
            });
            break;
        case 'error':
            Swal.fire({
                text: "{{ Session::get('message') }}",
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            });
            break;
    }
    @endif
</script>

<script type="text/javascript">

    // Delete Button
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#306ad6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link
                }
            })
        });
    });

    // Edit Button
    $(function () {
        $(document).on('click', '#edit', function (e) {
            e.preventDefault();
            var link = $(this).attr("href");
            window.location.href = link
        });
    });

    // Details Button
    $(function () {
        $(document).on('click', '.details-btn', function (e) {
            e.preventDefault();
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let shortDesc = response.detail.short_description
                        ? response.detail.short_description.substring(0, 20) + ' ...'
                        : '-';
                    let longDesc = response.detail.long_description
                        ? response.detail.long_description.substring(0, 20) + ' ...'
                        : '-';
                    Swal.fire({
                        html: `
                    <img style="height: 200px;width: auto;border-radius: 10px" src="${response.detail.images[0].url}" width="100" style="margin-bottom:10px;"/>
                    <p class="mt-4"><strong>${response.detail.title}</strong></p>
                    <div class="table-responsive">
                    <table class="table align-middle mb-0">
                    <tr>
                       <th>
                        Category Path
                       </th>
                       <td>
                        ${response.categoryPath}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Brand
                       </th>
                       <td>
                        ${response.detail.brand.brand_name}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Remark
                       </th>
                       <td>
                        ${response.detail.remark}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Short Description
                       </th>
                       <td>
                        ${shortDesc}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Long Description
                       </th>
                       <td>
                        ${longDesc}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Weight
                       </th>
                       <td>
                        ${response.detail.weight ?? '-'}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Length
                       </th>
                       <td>
                        ${response.detail.length ?? '-'}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Height
                       </th>
                       <td>
                        ${response.detail.height ?? '-'}
                       </td>
                    </tr>
                    <tr>
                       <th>
                        Width
                       </th>
                       <td>
                        ${response.detail.width ?? '-'}
                       </td>
                    </tr>
                    </table>
                    </div>
                `,
                        showConfirmButton: false,
                    });
                },
                error: function () {
                    Swal.fire("Error", "Something Wrong", "error");
                }
            });
        });
    });

    // Show Notification
    $(function () {
        $(document).on('click', '.show-notification', function (e) {
            e.preventDefault();
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let userName = response.notification.user.name;
                    let title = response.notification.title;
                    let message = response.notification.message;
                    let avatar = response.notification.user.profile_photo_path;
                    Swal.fire({
                        html: `
                    <div style="text-align: left;line-height: 1.8;">
                    <p class="mt-4"><strong><img src="${avatar}" class="user-img" alt="user avatar"> ${userName}</strong></p>
                    <p class="mt-4"><strong>Title:</strong> ${title}</p>
                    <p class="mt-4"><strong>Message:</strong> ${message}</p>
                    </div>
                `,
                        showConfirmButton: false,
                    });
                },
                error: function () {
                    Swal.fire("Error", "Something Wrong", "error");
                }
            });
        });
    });

    // Show Contact
    $(function () {
        $(document).on('click', '.show-contact', function (e) {
            e.preventDefault();
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let name = response.contact.name;
                    let email = response.contact.email;
                    let message = response.contact.message;
                    Swal.fire({
                        html: `
                    <div style="text-align: left;">
                    <p class="mt-4"><strong>${name}</strong></p>
                    <p class="mt-0"><strong></strong> ${email}</p>
                    <p style="line-height: 1.8;" class="mt-4"><strong></strong> ${message}</p>
                    </div>
                `,
                        showConfirmButton: false,
                    });
                },
                error: function () {
                    Swal.fire("Error", "Something Wrong", "error");
                }
            });
        });
    });

    // Image Button
    $(function () {
        $(document).on('click', '.image-btn', function (e) {
            e.preventDefault();
            let image = $(this).data('image');

            Swal.fire({
                html: `
                    <img style="height: auto;width: 500px;border-radius: 10px" src="${image}" width="100" style="margin-bottom:10px;"/>
                `,
                showConfirmButton: false,
                width: 600,
            });
        });
    });

    // Variants Button
    @if(Route::currentRouteName() == 'panel.products')
    $(function () {
        $(document).on('click', '.variants-btn', function (e) {
            e.preventDefault();

            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let variantsHtml;
                    if (!response.length) {
                        variantsHtml = `<p class="text-center my-3 text-danger"><strong>There Is No <u>VARIANTS</u> For This Product</strong></p>`;
                    } else {
                        let rows = response.map(variant => `
                            <tr>
                                <td>${variant.color?.color_name ?? '-'}</td>
                                <td>${variant.size?.size ?? '-'}</td>
                                <td>${variant.material?.title ?? '-'}</td>
                                <td>${variant.price ?? '-'}</td>
                                <td>${variant.discount ?? '-'}</td>
                                <td>${variant.stock ?? '-'}</td>
                                <td>${variant.star ?? '-'}</td>
                                <td>${variant.status}</td>
                                <td class="text-center">
                                    <div class="d-flex order-actions justify-content-center">
                                        <a class="variants-btn" href="{{ route('panel.edit.variant', '') }}/${variant.id}"
                                        id="edit">
                                           <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="{{ route('panel.delete.variant', '') }}/${variant.id}"
                                           id="delete" class="ms-4">
                                           <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `);

                        variantsHtml = `
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <tr>
                                         <td>
                                             <img style="height: 150px;width: auto;border-radius: 10px" src="${response[0].product.images[0].url}" width="100" style="margin-bottom:10px;"/>
                                         </td>
                                         <td>
                                             <h5 class="text-center my-3">${response[0].product.title}</h5>
                                         </td>
                                    </tr>
                                </table>
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Material</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Stock</th>
                                            <th>Star</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>${rows}</tbody>
                                </table>
                            </div>`;
                    }
                    Swal.fire({
                        html: variantsHtml,
                        width: 900,
                        showConfirmButton: false,
                    });
                },
                error: function () {
                    Swal.fire("Error", "Something Wrong", "error");
                }
            });
        });
    });
    @endif

    // Order List
    @if(Route::currentRouteName() == 'panel.orders')
    $(function () {
        $(document).on('click', '.show-order-list', function (e) {
            e.preventDefault();

            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let orderListHtml;
                    if (!response.length) {
                        orderListHtml = `<p class="text-center my-3 text-danger"><strong>There Is No <u>LIST</u> For This Order</strong></p>`;
                    } else {
                        console.log(response);
                        let rows = response.map(order => `
                            <tr>
                                <td class="text-start"><img class="prd-img" src="${order.variant.product.images[0].url}"> ${order.variant.product.title.substring(0, 30) + '...'}</td>
                                <td class="text-start">${order.variant.color?.color_name ?? '-'}</td>
                                <td class="text-start">${order.variant.size?.size ?? '-'}</td>
                                <td class="text-start">${order.variant.material?.title ?? '-'}</td>
                                <td class="text-start">${order.quantity}</td>
                                <td class="text-start">${order.variant.price}</td>
                                <td class="text-start">${order.variant.discount ?? '-'}</td>
                                <td class="text-center">
                                    <div class="d-flex order-actions justify-content-center">
                                        <a href="{{ route('panel.delete.order.list', '') }}/${order.id}"
                                           id="delete" class="ms-4">
                                           <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `);

                        orderListHtml = `
                            <div class="table-responsive">
                                <h4><img class="user-img" src="${response[0].user.profile_photo_path}"> ${response[0].user.name} Order List</h4>
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Title</th>
                                            <th class="text-start">Color</th>
                                            <th class="text-start">Size</th>
                                            <th class="text-start">Material</th>
                                            <th class="text-start">Quantity</th>
                                            <th class="text-start">Price</th>
                                            <th class="text-start">Discount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>${rows}</tbody>
                                </table>
                            </div>`;
                    }
                    Swal.fire({
                        html: orderListHtml,
                        width: 1000,
                        showConfirmButton: false,
                    });
                },
                error: function () {
                    Swal.fire("Error", "Something Wrong", "error");
                }
            });
        });
    });
    @endif

    // Change Password Button
    @if(Route::currentRouteName() == 'panel.users')
    $(document).on('click', '.change-password-btn', function (e) {
        e.preventDefault();
        const userId = $(this).closest('tr').find('.user-status').data('id');
        const userName = $(this).closest('tr').find('.user-status').data('name');

        Swal.fire({
            title: `Change ${userName} Password`,
            html:
                `<input autofocus type="password" id="new-password" class="swal2-input" placeholder="New Password">` +
                `<input type="password" id="confirm-password" class="swal2-input" placeholder="Confirm Password">`,
            showCancelButton: true,
            confirmButtonText: 'Change Password',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
            preConfirm: () => {
                const password = $('#new-password').val();
                const confirm = $('#confirm-password').val();

                if (!password || !confirm) {
                    Swal.showValidationMessage('Both Fields Are Required');
                    return false;
                }

                if (password !== confirm) {
                    Swal.showValidationMessage('Passwords Do Not Match');
                    return false;
                }

                return {password: password};
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('panel.user.change.password') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        password: result.value.password
                    },
                    success: function (res) {
                        Swal.fire('Success', 'Password changed successfully', 'success');
                    },
                    error: function () {
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            }
        });
    });

    @endif

    // Add New Address Button
    @if(Route::currentRouteName() == 'panel.edit.user')
    $(document).on('click', '.add-address-btn', function (e) {
        e.preventDefault();
        const userId = $(this).data('id');
        $.when(
            $.get('https://iranplacesapi.liara.run/api/provinces'),
            $.get('https://iranplacesapi.liara.run/api/cities')
        ).done(function (provincesData, citiesData) {
            let statesOptions = '<option value="">Select Province</option>';
            provincesData[0].forEach(function (province) {
                statesOptions += `<option value="${province.id}">${province.name}</option>`;
            });

            let citiesOptions = '<option value="">Select City</option>';
            citiesData[0].forEach(function (city) {
                citiesOptions += `<option value="${city.id}">${city.name}</option>`;
            });

            Swal.fire({
                title: `Add New Address`,
                html:
                    `<select id="new-state" class="swal2-select state-select">${statesOptions}</select>` +
                    `<select id="new-city" class="swal2-select city-select" style="margin-top: 30px;">${citiesOptions}</select>` +
                    `<textarea id="new-address" class="swal2-textarea" placeholder="Address"></textarea>` +
                    `<input type="text" id="new-postal-code" class="swal2-input" placeholder="Postal Code">` +
                    `<input type="number" id="new-no" class="swal2-input" placeholder="No">` +
                    `<input type="text" id="new-mobile" class="swal2-input" placeholder="Mobile">` +
                    `<input type="text" id="new-recipient-name" class="swal2-input" placeholder="Recipient Name">`,
                showCancelButton: true,
                confirmButtonText: 'Add',
                cancelButtonText: 'Cancel',
                focusConfirm: false,
                didOpen: () => {
                    $('.state-select').select2({
                        placeholder: "Select State",
                        dropdownParent: $('.swal2-popup'),
                        width: 280,
                    });

                    $('.city-select').select2({
                        placeholder: "Select City",
                        dropdownParent: $('.swal2-popup'),
                        width: 280,
                    }).next('.select2-container').css('margin-top', '20px');
                },
                preConfirm: () => {
                    const state_id = $('#new-state').val();
                    const city_id = $('#new-city').val();
                    const address = $('#new-address').val();
                    const postal_code = $('#new-postal-code').val();
                    const no = $('#new-no').val();
                    const mobile = $('#new-mobile').val();
                    const recipient_name = $('#new-recipient-name').val();

                    if (!state_id) {
                        Swal.showValidationMessage('State Is Required');
                        return false;
                    }

                    if (!city_id) {
                        Swal.showValidationMessage('City Is Required');
                        return false;
                    }

                    if (!address) {
                        Swal.showValidationMessage('Address Is Required');
                        return false;
                    }

                    if (!postal_code) {
                        Swal.showValidationMessage('Postal Code Is Required');
                        return false;
                    }

                    if (!mobile) {
                        Swal.showValidationMessage('Mobile Is Required');
                        return false;
                    }

                    return {
                        state_id,
                        city_id,
                        address,
                        postal_code,
                        no,
                        mobile,
                        recipient_name,
                    };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = result.value;
                    $.ajax({
                        url: '{{ route('panel.store.address') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: userId,
                            ...formData,
                        },
                        success: function (response) {
                            location.reload();
                            Swal.fire('Success', 'Address created successfully!', 'success');
                        },
                        error: function (xhr) {
                            let msg = 'Something went wrong';
                            if (xhr.responseJSON?.message) msg = xhr.responseJSON.message;
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }

            });
        });
    });

    @endif

    // Attributes Button
    @if(Route::currentRouteName() == 'panel.specifications')
    $(function () {
        $(document).on('click', '.attributes-btn', function (e) {
            e.preventDefault();

            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let attributesHtml;
                    if (!response.length) {
                        attributesHtml = `<p class="text-center my-3 text-danger"><strong>There Is No <u>ATTRIBUTES</u> For This Specification</strong></p>`;
                    } else {
                        let rows = response.map(attribute => `
                            <tr>
                                <td>${attribute.title}</td>
                                <td>${attribute.status}</td>
                                <td class="text-center">
                                    <div class="d-flex order-actions justify-content-center">
                                        <a class="variants-btn" href="{{ route('panel.edit.attribute', '') }}/${attribute.id}"
                                        id="edit">
                                           <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="{{ route('panel.delete.attribute', '') }}/${attribute.id}"
                                           id="delete" class="ms-4">
                                           <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `);

                        attributesHtml = `
                            <div class="table-responsive">
                                <h4>${response[0].specification.title}</h4>
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>${rows}</tbody>
                                </table>
                            </div>`;
                    }
                    Swal.fire({
                        html: attributesHtml,
                        width: 900,
                        showConfirmButton: false,
                    });
                },
                error: function () {
                    Swal.fire("Error", "Something Wrong", "error");
                }
            });
        });
    });
    @endif

</script>

{{--Select2--}}
<script>
    $(document).ready(function () {
        $('#brand-select').select2({
            placeholder: "Select Brand",
            allowClear: true
        });
        $('#category-select').select2({
            placeholder: "Select Category",
            allowClear: true
        });
        $('#remark-select').select2({
            placeholder: "Select Remark",
            allowClear: true
        });
        $('.unit-select').select2({
            placeholder: "Select Unti",
            allowClear: true
        });
        $('#color-select').select2({
            placeholder: "Select Color",
            allowClear: true
        });
        $('#size-select').select2({
            placeholder: "Select Size",
            allowClear: true
        });
        $('#material-select').select2({
            placeholder: "Select Material",
            allowClear: true
        });
        $('#status-select').select2({
            placeholder: "Select Status",
            allowClear: true
        });
        $('#specification-select').select2({
            placeholder: "Select Specification",
            allowClear: true
        });
        $('#role-select').select2({
            placeholder: "Select Role",
            allowClear: true
        });
        $('.state-select').select2({
            placeholder: "Select State",
            allowClear: true
        });
        $('.city-select').select2({
            placeholder: "Select City",
            allowClear: true
        });
        $('.rating-select').select2({
            placeholder: "Select Rating",
            allowClear: true
        });
        $('.payment-select').select2({
            placeholder: "Select Payment Rule",
            allowClear: true
        });
        $('.specification-checkbox').on('change', function () {
            const specId = $(this).data('spec-id');
            const $relatedFields = $(`.spec-fields[data-spec-id="${specId}"]`).find('input, select');

            if ($(this).is(':checked')) {
                $relatedFields.prop('disabled', false);
            } else {
                $relatedFields.prop('disabled', true);
            }
        });
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            language: 'en',
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>

</html>
