<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('publisher.dashboard') }}" class="logo logo-light">
        <span class="logo-lg">

            <img src="{{ $setting_dashboard->image_main_light_mode ? $setting_dashboard->image_main_light_mode : asset('assets/admin/images/default/logo.png') }}"
                alt="logo"  style="width: 200px; height: 120px;">
        </span>

        <span class="logo-sm">
            <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/default/logo-sm.png') }}"
                alt="small logo">

        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('publisher.dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ $setting_dashboard->image_main_dark_mode ? $setting_dashboard->image_main_dark_mode : asset('assets/admin/images/default/logo-dark.png') }}"
                alt="dark logo"  style="width: 200px; height: 120px;">
        </span>
        <span class="logo-sm">
            <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/default/logo-sm.png') }}"
                alt="small logo">
    @php
        $userRole = auth()->user()->roles->first();
        $permissions = $userRole ? $userRole->permissions->pluck('id', 'name') : collect();
        $permissions->has('dashboard');
    @endphp
    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-title">{{ __('Content Dashboard') }}</li>
            <li class="side-nav-item">
                <a href="{{ route('publisher.dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> {{ __('Dashboard') }} </span>
                </a>
            </li>
            @if (Auth::user()->role == 'agency' || Auth::user()->role == 'broker')
                <li class="side-nav-item {{ Route::is('publisher.users.*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('publisher.users.index') }}" class="side-nav-link ">
                        <i class="ri-group-line"></i>
                        <span class="badge bg-success float-end"></span>
                        <span> {{ __('Users') }} </span>
                    </a>
                </li>
            @endif
            {{-- @if ($permissions->has('publisher.roles.index'))
                <li class="side-nav-item {{ Route::is('publisher.roles.*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('publisher.roles.index') }}" class="side-nav-link ">
                        <i class="ri-lock-password-line"></i>
                        <span class="badge bg-success float-end"></span>
                        <span> {{ __('Roles') }} </span>
                    </a>
                </li>
            @endif --}}
            @if (Auth::user()->role == 'agency' || Auth::user()->role == 'broker')
                <li class="side-nav-item {{ Route::is('publisher.teams.*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('publisher.teams.index') }}" class="side-nav-link ">
                        <i class="ri-team-line"></i>
                        <span class="badge bg-success float-end"></span>
                        <span> {{ __('Team') }} </span>
                    </a>
                </li>
            @endif
            {{-- @if (Auth::user()->role == 'agency')
                <li class="side-nav-item {{ Route::is('publisher.projects.*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('publisher.projects.index') }}" class="side-nav-link ">
                        <i class="ri-user-line"></i>
                        <span class="badge bg-success float-end"></span>
                        <span> {{ __('project') }} </span>
                    </a>
                </li>
            @endif --}}

            <li class="side-nav-item {{ Route::is('publisher.units.*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('publisher.units.index') }}" class="side-nav-link ">
                    <i class="ri-product-hunt-fill"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> {{ __('Units') }} </span>
                </a>
            </li>

            {{-- @if ($permissions->has('publisher.price_package.index'))
                <li class="side-nav-item {{ Route::is('publisher.price_package.*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('publisher.price_package.index') }}" class="side-nav-link ">
                        <i class="ri-product-hunt-fill"></i>
                        <span class="badge bg-success float-end"></span>
                        <span> {{ __('Price Package') }} </span>
                    </a>
                </li>
            @endif --}}
            {{-- @if (Auth::user()->role == 'agency' || Auth::user()->role == 'broker')
                @if ($permissions->has('publisher.advertisements.index'))
                    <li
                        class="side-nav-item {{ Route::is('publisher.advertisements.index*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('publisher.advertisements.index') }}" class="side-nav-link ">
                            <i class="ri-advertisement-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('Sponsored Advertisement') }} </span>
                        </a>
                    </li>
                @endif
            @endif
            @if (Auth::user()->role == 'agency' || Auth::user()->role == 'broker')
                @if ($permissions->has('publisher.my_ads'))
                    <li class="side-nav-item {{ Route::is('publisher.my_ads*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('publisher.my_ads') }}" class="side-nav-link ">
                            <i class="ri-price-tag-2-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('My Ads') }} </span>
                        </a>
                    </li>
                @endif
            @endif --}}

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
