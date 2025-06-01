<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('dashboard') }}"><img src="{{ url('upload/project/logo.jpg') }}" class="logo-icon" alt="logo icon"></a>
        </div>
        <div>
            <a href="{{ route('dashboard') }}"><h4 class="logo-text">Admin Panel</h4></a>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @can('edit-user')
            <li class="menu-label">User</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">User</div>
                </a>
                <ul>
                    <li> <a href="{{ route('panel.users') }}"><i class="bx bx-right-arrow-alt"></i>All User</a>
                    </li>
                    <li> <a href="{{ route('panel.create.user') }}"><i class="bx bx-right-arrow-alt"></i>Add User</a>
                    </li>
                </ul>
            </li>
        @endcan
        <li class="menu-label">Site Information</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-info-circle'></i>
                </div>
                <div class="menu-title">Information</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.about-us') }}"><i class="bx bx-info-circle"></i>About Us</a>
                </li>
                <li> <a href="{{ route('panel.refund-policy') }}"><i class="bx bxl-paypal"></i>Refund Policy</a>
                </li>
                <li> <a href="{{ route('panel.purchase-policy') }}"><i class="bx bx-purchase-tag"></i>Purchase Policy</a>
                </li>
                <li> <a href="{{ route('panel.privacy-policy') }}"><i class="bx bx-check-shield"></i>Privacy Policy</a>
                </li>
                <li> <a href="{{ route('panel.address') }}"><i class="bx bx-current-location"></i>Address</a>
                </li>
                <li> <a href="{{ route('panel.links') }}"><i class="bx bx-link"></i>Links</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Category</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.categories') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>
                <li> <a href="{{ route('panel.create.category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Slider</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-image'></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.sliders') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                <li> <a href="{{ route('panel.create.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Order</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-list-check'></i>
                </div>
                <div class="menu-title">Order List</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.orders') }}"><i class="bx bx-right-arrow-alt"></i>All Order</a>
                </li>
                <li> <a href="{{ route('panel.pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>
                <li> <a href="{{ route('panel.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
                </li>
                <li> <a href="{{ route('panel.completed.order') }}"><i class="bx bx-right-arrow-alt"></i>Completed Order</a>
                </li>
                <li> <a href="{{ route('panel.cancelled.order') }}"><i class="bx bx-right-arrow-alt"></i>Canceled Order</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Product</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxl-product-hunt'></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.products') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li> <a href="{{ route('panel.create.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                <li> <a href="{{ route('panel.reviews') }}"><i class="bx bx-right-arrow-alt"></i>Reviews</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-detail'></i>
                </div>
                <div class="menu-title">Specification</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.specifications') }}"><i class="bx bx-right-arrow-alt"></i>All Specification</a>
                </li>
                <li> <a href="{{ route('panel.create.specification') }}"><i class="bx bx-right-arrow-alt"></i>Add Specification</a>
                </li>
                <li> <a href="{{ route('panel.attributes') }}"><i class="bx bx-right-arrow-alt"></i>All Attributes</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-color-fill'></i>
                </div>
                <div class="menu-title">Color</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.colors') }}"><i class="bx bx-right-arrow-alt"></i>All Color</a>
                </li>
                <li> <a href="{{ route('panel.create.color') }}"><i class="bx bx-right-arrow-alt"></i>Add Color</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-font-size'></i>
                </div>
                <div class="menu-title">Size</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.sizes') }}"><i class="bx bx-right-arrow-alt"></i>All Size</a>
                </li>
                <li> <a href="{{ route('panel.create.size') }}"><i class="bx bx-right-arrow-alt"></i>Add Size</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-unite'></i>
                </div>
                <div class="menu-title">Unit</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.units') }}"><i class="bx bx-right-arrow-alt"></i>All Unit</a>
                </li>
                <li> <a href="{{ route('panel.create.unit') }}"><i class="bx bx-right-arrow-alt"></i>Add Unit</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-category-alt'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.brands') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                </li>
                <li> <a href="{{ route('panel.create.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cube-alt'></i>
                </div>
                <div class="menu-title">Material</div>
            </a>
            <ul>
                <li> <a href="{{ route('panel.materials') }}"><i class="bx bx-right-arrow-alt"></i>All Material</a>
                </li>
                <li> <a href="{{ route('panel.create.material') }}"><i class="bx bx-right-arrow-alt"></i>Add Material</a>
                </li>
            </ul>
        </li>

{{--        <li>--}}
{{--            <a class="has-arrow" href="javascript:;">--}}
{{--                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Components</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <li> <a href="component-alerts.html"><i class="bx bx-right-arrow-alt"></i>Alerts</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i>Badges</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-buttons.html"><i class="bx bx-right-arrow-alt"></i>Buttons</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-cards.html"><i class="bx bx-right-arrow-alt"></i>Cards</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-carousels.html"><i class="bx bx-right-arrow-alt"></i>Carousels</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-list-groups.html"><i class="bx bx-right-arrow-alt"></i>List Groups</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-media-object.html"><i class="bx bx-right-arrow-alt"></i>Media Objects</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-modals.html"><i class="bx bx-right-arrow-alt"></i>Modals</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Navs & Tabs</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-navbar.html"><i class="bx bx-right-arrow-alt"></i>Navbar</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-paginations.html"><i class="bx bx-right-arrow-alt"></i>Pagination</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-popovers-tooltips.html"><i class="bx bx-right-arrow-alt"></i>Popovers & Tooltips</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-progress-bars.html"><i class="bx bx-right-arrow-alt"></i>Progress</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-spinners.html"><i class="bx bx-right-arrow-alt"></i>Spinners</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-notifications.html"><i class="bx bx-right-arrow-alt"></i>Notifications</a>--}}
{{--                </li>--}}
{{--                <li> <a href="component-avtars-chips.html"><i class="bx bx-right-arrow-alt"></i>Avatrs & Chips</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a class="has-arrow" href="javascript:;">--}}
{{--                <div class="parent-icon"><i class="bx bx-repeat"></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Content</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <li> <a href="content-grid-system.html"><i class="bx bx-right-arrow-alt"></i>Grid System</a>--}}
{{--                </li>--}}
{{--                <li> <a href="content-typography.html"><i class="bx bx-right-arrow-alt"></i>Typography</a>--}}
{{--                </li>--}}
{{--                <li> <a href="content-text-utilities.html"><i class="bx bx-right-arrow-alt"></i>Text Utilities</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a class="has-arrow" href="javascript:;">--}}
{{--                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Icons</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <li> <a href="icons-line-icons.html"><i class="bx bx-right-arrow-alt"></i>Line Icons</a>--}}
{{--                </li>--}}
{{--                <li> <a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i>Boxicons</a>--}}
{{--                </li>--}}
{{--                <li> <a href="icons-feather-icons.html"><i class="bx bx-right-arrow-alt"></i>Feather Icons</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="menu-label">Forms & Tables</li>--}}
{{--        <li>--}}
{{--            <a class="has-arrow" href="javascript:;">--}}
{{--                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Forms</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <li> <a href="form-elements.html"><i class="bx bx-right-arrow-alt"></i>Form Elements</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>Input Groups</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-layouts.html"><i class="bx bx-right-arrow-alt"></i>Forms Layouts</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-validations.html"><i class="bx bx-right-arrow-alt"></i>Form Validation</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-wizard.html"><i class="bx bx-right-arrow-alt"></i>Form Wizard</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-text-editor.html"><i class="bx bx-right-arrow-alt"></i>Text Editor</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-file-upload.html"><i class="bx bx-right-arrow-alt"></i>File Upload</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-date-time-pickes.html"><i class="bx bx-right-arrow-alt"></i>Date Pickers</a>--}}
{{--                </li>--}}
{{--                <li> <a href="form-select2.html"><i class="bx bx-right-arrow-alt"></i>Select2</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a class="has-arrow" href="javascript:;">--}}
{{--                <div class="parent-icon"><i class="bx bx-grid-alt"></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Tables</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <li> <a href="table-basic-table.html"><i class="bx bx-right-arrow-alt"></i>Basic Table</a>--}}
{{--                </li>--}}
{{--                <li> <a href="table-datatable.html"><i class="bx bx-right-arrow-alt"></i>Data Table</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="https://themeforest.net/user/codervent" target="_blank">--}}
{{--                <div class="parent-icon"><i class="bx bx-support"></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Support</div>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
    <!--end navigation-->
</div>
