<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ route('admin.dashboard') }}" class="logo-light">
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
                <a href="{{ route('admin.dashboard') }}" class="logo-dark">
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
            {{-- {{ Illuminate\Support\Facades\Lang::get('locale.' . app()->getLocale()) }} --}}
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
                            class="me-1" height="12"> <span
                            class="align-middle">{{Illuminate\Support\Facades\Lang::get($local) }}</span>
                    </a>
                    @endforeach
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
                        <h5 class="my-0 fw-normal">{{ Auth::guard('admin')->user()->name }}<i
                                class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
                    <!-- item-->
                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                        <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>

                    {{--
                    <!-- item-->
                    <a href="{{ route('admin.setting.dashboard.index') }}" class="dropdown-item">
                        <i class="ri-settings-4-line fs-18 align-middle me-1"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <!-- item--> --}}
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="route('admin.logout')" onclick="event.preventDefault();
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