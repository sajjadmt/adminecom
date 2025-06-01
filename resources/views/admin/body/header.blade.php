@php use Illuminate\Support\Str; @endphp
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">{{ $notificationCount }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @foreach($notifications as $notification)
                                    <a class="dropdown-item" href="{{ route('panel.notifications') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-warning text-warning"><i
                                                    class="bx bxs-bell-ring"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">{{ Str::limit($notification->title, 15, '...') }}
                                                    <span
                                                        class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span></h6>
                                                <p class="msg-info">{{ Str::limit($notification->message, 30, '...') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <a href="{{ route('panel.notifications') }}">
                                <div class="text-center msg-footer">View All Notifications</div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">{{ $contactCount }}</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="header-message-list">
                                @foreach($contacts as $contact)
                                    <a class="dropdown-item" href="{{ route('panel.contacts') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i
                                                    class="bx bx-message"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">{{ Str::limit($contact->name, 15, '...') }}
                                                    <span
                                                        class="msg-time float-end">{{ $contact->created_at->diffForHumans() }}</span></h6>
                                                <p class="msg-info">{{ Str::limit($contact->message, 30, '...') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <a href="{{ route('panel.contacts') }}">
                                <div class="text-center msg-footer">View All Messages</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->profile_photo_path }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                        <p class="designattion mb-0">Admin</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
