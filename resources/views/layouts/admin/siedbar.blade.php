<div class="leftside-menu overflow-y-auto overflow-hidden scrollbar-width-none p-1" style="scrollbar-width: none">
    <!-- LOGO -->
    <div class="text-center">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-lg">
                <img src="{{ $setting_dashboard->image_main_dark_mode ? $setting_dashboard->image_main_dark_mode : asset('assets/admin/images/default/logo-dark.png') }}"
                    alt="dark logo" style="height: 100px;">
            </span>
            <span class="logo-sm">
                <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/default/logo-sm.png') }}"
                    alt="small logo">
            </span>
        </a>

        <a href="{{ route('admin.dashboard') }}" class="logo logo-light m-3">

            <span class="logo-lg">
                <img src="{{ $setting_dashboard->image_main_light_mode ? $setting_dashboard->image_main_light_mode : asset('assets/admin/images/default/logo.png') }}"
                    alt="logo" style="height: 100px;">
            </span>
            <span class="logo-sm">
                <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/default/logo-sm.png') }}"
                    alt="small logo">
            </span>
        </a>
    </div>
    @php
        $userRole = auth()->user()->roles->first();
        $permissions = $userRole ? $userRole->permissions->pluck('id', 'name') : collect();
        $permissions->has('dashboard');
    @endphp
    <!-- Brand Logo Dark -->
    {{-- <a href="{{ route('admin.dashboard') }}" class="logo logo-dark m-3"> --}}

        <!-- Sidebar -left -->
        <div class="h-100" id="leftside-menu-container" data-simplebar>
            <!--- Sidemenu -->
            <ul class="side-nav">
                <li class="side-nav-title">{{ __('Content Dashboard') }}</li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                        <i class="ri-dashboard-3-line"></i>
                        <span class="badge bg-success float-end"></span>
                        <span> {{ __('Dashboard') }} </span>
                    </a>
                </li>
                @if ($permissions->has('admin.admins.index'))
                    <li class="side-nav-item {{ Route::is('admin.admins.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.admins.index') }}" class="side-nav-link ">
                            <i class="ri-group-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('Admins') }} </span>
                        </a>
                    </li>
                @endif
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#UsersDrop" aria-expanded="false" aria-controls="UsersDrop"
                        class="side-nav-link collapsed">
                        <i class="ri-user-heart-line"></i>
                        <span> {{ __('Users') }} </span>
                        <span class="menu-arrow"></span>
                        <i class="ri-arrow-down-s-line"></i>
                    </a>
                    <div class="collapse" id="UsersDrop" style="">
                        <ul class="side-nav-second-level">
                            @if ($permissions->has('admin.users.index'))
                                <li>
                                    <a href="{{ route('admin.users.index') }}">{{ __('All Users') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.brokers.index'))
                                <li>
                                    <a href="{{ route('admin.brokers.index') }}">{{ __('All Brokers') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.agency.index'))
                                <li>
                                    <a href="{{ route('admin.agency.index') }}">{{ __('All Developers') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.unit_owners.index'))
                                <li>
                                    <a href="{{ route('admin.unit_owners.index') }}">{{ __('All Unit Owners') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if ($permissions->has('admin.teams.index'))
                    <li class="side-nav-item {{ Route::is('admin.teams.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.teams.index') }}" class="side-nav-link ">
                            <i class="ri-team-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('Teams') }} </span>
                        </a>
                    </li>
                @endif
                @if ($permissions->has('admin.roles.index'))
                    <li class="side-nav-item {{ Route::is('admin.roles.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.roles.index') }}" class="side-nav-link ">
                            <i class="ri-lock-password-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('Roles') }} </span>
                        </a>
                    </li>
                @endif
                @if ($permissions->has('admin.contacts.index'))
                    <li class="side-nav-item {{ Route::is('admin.contact.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.contacts.index') }}" class="side-nav-link ">
                            <i class="ri-pushpin-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('contact') }} </span>
                        </a>
                    </li>
                @endif
                @if ($permissions->has('admin.service_providers.index'))
                    <li class="side-nav-item {{ Route::is('admin.service_providers.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.service_providers.index') }}" class="side-nav-link ">
                            <i class="ri-pushpin-line"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('Service providers') }} </span>
                        </a>
                    </li>
                @endif
                <li class="side-nav-title">{{ __('Content WebSite') }}</li>



                @if ($permissions->has('admin.districts.index'))
                    <li class="side-nav-item {{ Route::is('admin.districts.*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.districts.index') }}" class="side-nav-link ">
                            <i class="ri-pin-distance-fill"></i>
                            <span class="badge bg-success float-end"></span>
                            <span> {{ __('Districts') }} </span>
                        </a>
                    </li>
                @endif

                @if ($permissions->has('admin.categories.index') || $permissions->has('admin.categories.deleted'))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#Categories" aria-expanded="false" aria-controls="Categories"
                            class="side-nav-link collapsed">
                            <i class="ri-newspaper-fill"></i>
                            <span> {{ __('Categories') }} </span>
                            <span class="menu-arrow"></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </a>
                        <div class="collapse" id="Categories" style="">
                            <ul class="side-nav-second-level">
                                @if ($permissions->has('admin.categories.index'))
                                    <li>
                                        <a href="{{ route('admin.categories.index') }}">{{ __('All Categories') }}</a>
                                    </li>
                                @endif
                                @if ($permissions->has('admin.categories.deleted'))
                                    <li>
                                        <a href="{{ route('admin.categories.deleted') }}">{{ __('Categories Trash') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if ($permissions->has('admin.offers.index'))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#offers" aria-expanded="false" aria-controls="offers"
                            class="side-nav-link collapsed">
                            <i class="ri-chat-history-line"></i>
                            <span> {{ __('Offers') }} </span>
                            <span class="menu-arrow"></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </a>
                        <div class="collapse" id="offers" style="">
                            <ul class="side-nav-second-level">
                                @if ($permissions->has('admin.offers.index'))
                                    <li>
                                        <a href="{{ route('admin.offers.index') }}">{{ __('All Offers') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#buildings" aria-expanded="false" aria-controls="buildings"
                        class="side-nav-link collapsed">
                        <i class="ri-community-fill"></i>
                        <span> {{ __('Buildings') }} </span>
                        <span class="menu-arrow"></span>
                        <i class="ri-arrow-down-s-line"></i>
                    </a>
                    <div class="collapse" id="buildings" style="">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="{{ route('admin.buildings.index') }}">{{ __('Buildings') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.buildings.deleted') }}">{{ __('Buildings Trash') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if ($permissions->has('admin.lands.index'))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#lands" aria-expanded="false" aria-controls="lands"
                            class="side-nav-link collapsed">
                            <i class="ri-landscape-line"></i>
                            <span> {{ __('Lands') }} </span>
                            <span class="menu-arrow"></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </a>
                        <div class="collapse" id="lands" style="">
                            <ul class="side-nav-second-level">
                                @if ($permissions->has('admin.lands.index'))
                                    <li>
                                        <a href="{{ route('admin.lands.index') }}">{{ __('All Lands') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if ($permissions->has('admin.jobs.index'))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#jobs" aria-expanded="false" aria-controls="jobs"
                            class="side-nav-link collapsed">
                            <i class="ri-printer-cloud-line"></i>
                            <span> {{ __('jobs') }} </span>
                            <span class="menu-arrow"></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </a>
                        <div class="collapse" id="jobs" style="">
                            <ul class="side-nav-second-level">
                                @if ($permissions->has('admin.jobs.index'))
                                    <li>
                                        <a href="{{ route('admin.jobs.index') }}">{{ __('All Jobs') }}</a>
                                        <a href="{{ route('admin.jobs-register.index') }}">{{ __('All Jobs Register') }}</a>

                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('admin.category_job.index') }}">{{ __('Category Job') }}</a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.category_job.deleted') }}">{{ __('Category Job Trash') }}</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endif
                @if ($permissions->has('admin.news.index'))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#news" aria-expanded="false" aria-controls="news"
                            class="side-nav-link collapsed">
                            <i class="ri-printer-cloud-line"></i>
                            <span> {{ __('News') }} </span>
                            <span class="menu-arrow"></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </a>
                        <div class="collapse" id="news" style="">
                            <ul class="side-nav-second-level">
                                @if ($permissions->has('admin.news.index') && ('admin.categories_news.index') && ('admin.tegs_news.index'))
                                    <li>
                                        <a href="{{ route('admin.news.index') }}">{{ __('All News') }}</a>
                                    </li>
                                @endif
                                <li class="side-nav-item {{ Route::is('admin.news.*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.news.create') }}" class="side-nav-link ">
                                        <i class="ri-article-line"></i>
                                        <span class="badge bg-success float-end"></span>
                                        <span> {{ __('Add News') }} </span>
                                    </a>
                                </li>
                                <li
                                    class="side-nav-item {{ Route::is('admin.categories_news.*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.categories_news.index') }}" class="side-nav-link ">
                                        <i class="ri-article-line"></i>
                                        <span class="badge bg-success float-end"></span>
                                        <span> {{ __('Categories News') }} </span>
                                    </a>
                                </li>
                                <li class="side-nav-item {{ Route::is('admin.tegs_news.*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.tegs_news.index') }}" class="side-nav-link ">
                                        <i class="ri-pushpin-line"></i>
                                        <span class="badge bg-success float-end"></span>
                                        <span> {{ __('News Tag') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#Services" aria-expanded="false" aria-controls="Services"
                        class="side-nav-link collapsed">
                        <i class="ri-newspaper-fill"></i>
                        <span> {{ __('Services') }} </span>
                        <span class="menu-arrow"></span>
                        <i class="ri-arrow-down-s-line"></i>
                    </a>
                    <div class="collapse" id="Services" style="">
                        <ul class="side-nav-second-level">
                            @if ($permissions->has('admin.services.index'))
                                <li>
                                    <a href="{{ route('admin.services.index') }}">{{ __('All Services') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.category_service.index'))
                                <li>
                                    <a href="{{ route('admin.category_service.index') }}">{{ __('Category Service') }}</a>
                                </li>
                            @endif
                            {{-- @if ($permissions->has('admin.features.index'))
                            <li>
                                <a href="{{ route('admin.features.index') }}">{{ __('Features') }}</a>
                            </li>
                            @endif --}}

                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#Units" aria-expanded="false" aria-controls="Units"
                        class="side-nav-link collapsed">
                        <i class="ri-product-hunt-fill"></i>
                        <span> {{ __('Units') }} </span>
                        <span class="menu-arrow"></span>
                        <i class="ri-arrow-down-s-line"></i>
                    </a>
                    <div class="collapse" id="Units" style="">
                        <ul class="side-nav-second-level">
                            @if ($permissions->has('admin.units.index'))
                                <li>
                                    <a href="{{ route('admin.units.index') }}">{{ __('All Units') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.units.primum.index'))
                                <li>
                                    <a href="{{ route('admin.units.primum.index') }}">{{ __('All Primum Units') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.units.deleted'))
                                <li>
                                    <a href="{{ route('admin.units.deleted') }}">{{ __('Units Trash') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.properties.index'))
                                <li>
                                    <a href="{{ route('admin.properties.index') }}">{{ __('Facilities') }}</a>
                                </li>
                            @endif
                            @if ($permissions->has('admin.gates.index'))
                                <li>
                                    <a href="{{ route('admin.gates.index') }}">{{ __('Gates') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false"
                        aria-controls="sidebarBaseUI" class="side-nav-link collapsed">
                        <i class="ri-settings-3-line"></i>
                        <span> {{ __('Settings') }} </span>
                        <span class="menu-arrow"></span>
                        <i class="ri-arrow-down-s-line"></i>
                    </a>
                    <div class="collapse" id="sidebarBaseUI" style="">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="{{ route('admin.setting.dashboard.index') }}">{{ __('Setting Dashboard') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.setting.website.index') }}">{{ __('Setting WebSite') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.page.index') }}">{{ __('Pages Setting') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!--- End Sidemenu -->

            <div class="clearfix"></div>
        </div>
</div>