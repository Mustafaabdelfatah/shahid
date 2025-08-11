@extends('admin.dashboard')
@section('title', 'Profile')
@section('content')
    <!-- start page title -->
    <div class="row">
        @livewire('profile-info', ['user' => $user])
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#aboutme">{{ __('About') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#edit-profile">{{ __('Settings') }}</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#Password"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#Password">{{ __('Chnage Password') }}</a>
                            </li>
                            @if ($user->relationLoaded('projects') && $user->projects->isNotEmpty())
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#projects"
                                    type="button" role="tab" aria-controls="home" aria-selected="true"
                                    href="#projects">{{ __('Projects') }}</a>
                            </li>
                            @endif
                            @if ($user->relationLoaded('units') && $user->units->isNotEmpty())
                        <li class="nav-item" role="presentation">
                            <a href="#units" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                                aria-selected="false" role="tab" tabindex="-1">
                                {{ __('Units') }}
                            </a>
                        </li>
                    @endif
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <div class="profile-desk">
                                    <h5 class="text-uppercase fs-17 text-dark">{{ $user->name }}</h5>
                                    <div class="designation mb-4">{{ @$user->positions }}</div>
                                    <p class="text-muted fs-16">
                                        {{ @$user->bio }}
                                    </p>
                                    <h5 class="mt-4 fs-17 text-dark">{{ __('Contact Information') }}</h5>
                                    <table class="table table-condensed mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ __('Email') }}</th>
                                                <td>
                                                    {{ @$user->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Phone') }}</th>
                                                <td class="ng-binding">{{ @$user->phone }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->
                            <!-- settings -->
                            <div id="edit-profile" class="tab-pane">
                                <div class="user-profile-content">
                                    @livewire('profile-details')
                                </div>
                            </div>
                            @if ($user->relationLoaded('projects') && $user->projects->isNotEmpty())
                            <!-- profile -->
                            <div id="projects" class="tab-pane">
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('Project Name') }}</th>
                                                        <th>{{ __('Created At') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user->projects as $item)
                                                        <tr>
                                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                                            <td>{{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                            </td>
                                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                                            <td>
                                                                @if ($item->status == 1)
                                                                <span class="badge bg-purple">{{__('Active')}}</span>
                                                                @else
                                                                <span class="badge bg-success">{{__('Un Active')}}</span>
                                                                    
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <div class=" d-flex  justify-content-around">
                                                                  
                                                                    <a href="{{ route('admin.project.show', $item->id) }}"
                                                                        class="btn btn-pink btn-sm"
                                                                        title="{{ __('Show') }}"><i
                                                                            class="ri-eye-fill"></i></a>
                                                                    <a href="{{ route('admin.project.edit', $item->id) }}"
                                                                        class="btn btn-primary btn-sm"
                                                                        title="{{ __('Edit') }}"><i
                                                                            class="ri-edit-line"></i></a>

                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#danger-header-modal{{ $item->id }}"
                                                                        title="{{ __('Delete') }}"><i
                                                                            class="ri-delete-bin-line"></i></button>
                                                                </div>
                                                                @include('admin.pages.project._model_delete')
                                                            </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                    @if ($user->relationLoaded('units') && $user->units->isNotEmpty())
                    <div class="tab-pane" id="units" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($user->units as $item)
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card card-selectable" data-radio-id="unit-{{ $item->id }}">
                                            {{-- <div class="form-check">
                                                <input class="form-check-input" type="radio" name="selected_unit" id="unit-{{ $item->id }}"
                                                    value="{{ $item->id }}">
                                            </div> --}}
                                            <div style="height: 200px; overflow: hidden;"> <!-- Set a fixed height for the image container -->
                                                <img src="{{ $item->images()->first()->image }}" class="card-img-top card-img-custom" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->trans->where('locale', $current_lang)->first()->title }}</h5>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><i class="ri-money-dollar-circle-line"></i>
                                                                {{ __('Price') }}:
                                                                {{ $item->price }}</li>
                                                            <li class="list-group-item"><i class="ri-coins-line"></i> {{ __('Service Charges') }}:
                                                                {{ $item->service_charges }}</li>
                                                            <li class="list-group-item"><i class="ri-layout-5-line"></i> {{ __('Size') }}:
                                                                {{ $item->size }}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><i class="ri-checkbox-circle-line"></i> {{ __('Type') }}
                                                                :
                                                                {{ $item->type }}</li>
                                                            <li class="list-group-item"><i class="ri-hotel-bed-line"></i> {{ __('Rooms') }}:
                                                                {{ $item->rooms }}</li>
                                                            <li class="list-group-item"><i class="ri-barcode-line"></i> {{ __('Code') }}:
                                                                {{ $item->code }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><i class="ri-creative-commons-by-fill"></i>
                                                                {{ __('Bathroom') }}:
                                                                {{ $item->bathroom }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><i class="ri-stack-line"></i> Floor:
                                                                {{ $item->floor }}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><i class="ri-map-pin-user-line"></i>
                                                                {{ __('Created By ') }}:
                        
                                                                <span class="fw-bold text-capitalize ">{{ $item->admin->name }}</span>
                                                            </li>
                                                            <li class="list-group-item"><i class="ri-map-pin-time-line"></i>
                                                                {{ __('Created At ') }}:
                                                                <small
                                                                    class="fw-normal text-muted float-end ms-1">{{ $item->created_at->diffForHumans() }}</small>
                                                            </li>
                        
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card-body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col-->
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                            <!-- profile -->
                            <div id="Password" class="tab-pane">
                                <div class="row m-t-10">

                                    {{-- <div class="mb-4 text-sm text-gray-600">
                                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                        </div> --}}

                                    <form action="{{ route('admin.profile.change_password') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- @method('PUT') --}}
                                        <div class="card-body">
                                            <div class="row">
                                                <form action="" method="POST">
                                                    @csrf
                                                    <div class="card-body">
                                                        @if (session('status'))
                                                            <div class="alert alert-success" role="alert">
                                                                {{ session('status') }}
                                                            </div>
                                                        @elseif (session('error'))
                                                            <div class="alert alert-danger" role="alert">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif
                                                        <div class="mb-3">
                                                            <label for="oldPasswordInput" class="form-label">Old
                                                                Password</label>
                                                            <input name="old_password" type="password"
                                                                class="form-control @error('old_password') is-invalid @enderror"
                                                                id="oldPasswordInput" placeholder="Old Password">
                                                            @error('old_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="newPasswordInput" class="form-label">New
                                                                Password</label>
                                                            <input name="new_password" type="password"
                                                                class="form-control @error('new_password') is-invalid @enderror"
                                                                id="newPasswordInput" placeholder="New Password">
                                                            @error('new_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="confirmNewPasswordInput"
                                                                class="form-label">Confirm New Password</label>
                                                            <input name="new_password_confirmation" type="password"
                                                                class="form-control" id="confirmNewPasswordInput"
                                                                placeholder="Confirm New Password">
                                                        </div>

                                                    </div>

                                                    <div>
                                                        <button type="submit"
                                                            class="btn btn-success float-end">{{ __('Edit') }}</button>
                                                    </div>
                                                </form>
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
    </div>
    <!-- end page title -->
@endsection
