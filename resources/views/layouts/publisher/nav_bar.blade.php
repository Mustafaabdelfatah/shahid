<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="index.html" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ $setting_dashboard->image_main_light_mode ? $setting_dashboard->image_main_light_mode : asset('assets/admin/images/default/logo.png') }}"
                            alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/default/logo-sm.png') }}"
                            alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ $setting_dashboard->image_main_light_mode ? $setting_dashboard->image_main_light_mode : asset('assets/admin/images/default/logo.png') }}"
                            alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/default/logo-sm.png') }}"
                            alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="ri-menu-line"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>


        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line fs-22"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/admin/images/flags/' . app()->getLocale() . '_flag.jpg') }}"
                        alt="user-image" class="me-0 me-sm-1" height="12">
                    <span class="align-middle d-none d-lg-inline-block">
                        {{ Illuminate\Support\Facades\Lang::get(app()->getLocale()) }}</span> <i
                        class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                    @foreach ($locals as $local)
                    <a href="{{ \LaravelLocalization::getLocalizedURL($local, \Request::fullUrl()) }}"
                        class="dropdown-item">
                        <img src="{{ asset('assets/admin/images/flags/' . $local . '_flag.jpg') }}" alt="{{ $local }}"
                            class="me-1" height="12"> <span class="align-middle">{{
                            Illuminate\Support\Facades\Lang::get($local)
                            }}</span>
                    </a>
                    @endforeach
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false" id="notificationDropdown">
                    <i class="ri-mail-line fs-22"></i>
                    @if (Auth::user()->unreadNotifications->count() > 0)
                    <span class="noti-icon-badge badge text-bg-purple" id="notificationCount">
                        {{ Auth::user()->unreadNotifications->count() }}
                    </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-16 fw-semibold">{{ __('Notification') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div style="max-height: 300px;" data-simplebar>
                        @foreach (Auth::user()->unreadNotifications->take(5) as $notification)
                        <a href="#"
                            class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none @if ($notification->read_at === null) bg-light  @else bg-white @endif"
                            data-id="{{ $notification->id }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">
                                            {{ @$notification->data['title'] }}
                                            {{ @$notification->data['product_title'] }}
                                            <small class="fw-normal text-muted float-end ms-1">{{
                                                @$notification->created_at->diffForHumans() }}</small>
                                        </h5>
                                        <small class="noti-item-subtitle text-muted">{{ @$notification->data['message']
                                            }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </li>

            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-line fs-22"></i>
                </a>
            </li>
            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ Auth::user()->image ? Auth::user()->image : asset('assets/admin/images/default/avatar-1.jpg') }}"
                            alt="user-image" width="32" class="rounded-circle">

                    </span>
                    <span class="d-lg-block d-none">
                        <h5 class="my-0 fw-normal">{{ Auth::user()->name }}<i
                                class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    @if(auth::user()->role !== 'agency' && auth::user()->role !== 'broker')
                    <a href="{{ route('publisher.teams.show', auth::user()->id) }}" class="dropdown-item">
                        <i class="ri-team-line fs-18 align-middle me-1"></i>
                        <span>{{ __('My Team') }}</span>
                    </a>
                    @endif



                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();" class="dropdown-item">
                            <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                            <span>Logout</span>
                        </a>
                    </form>

                </div>
            </li>
        </ul>
    </div>
</div>