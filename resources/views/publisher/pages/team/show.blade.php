@extends('publisher.dashboard')
@section('title', __('Teams'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{ __('All Teams') }}</h4>
            <p class="text-muted fs-15">{{ __('Team name is :') }} {{ @$team_user->team?->title }}</p>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">

        <h4 class="page-title mt-2 p-2">{{ __('Manger Team') }}</h4>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
            <div class="d-flex">
                <a class="me-3" href="#">
                    <img class="avatar-md rounded-circle bx-s"
                        src="{{ $team_user->team->user->image ? $team_user->team->user->image : asset('assets/admin/images/default/avatar-1.jpg') }}"
                        alt="">
                </a>
                <div class="info">
                    <h5 class="fs-18 my-1">{{ $team_user->team->user->name }}</h5>
                    <p class="text-muted fs-15">{{ $team_user->team->user->email }}</p>
                </div>
            </div>

        </div>
        <hr>
        <ul class="social-list list-inline mt-3 mb-0">
            <li class="list-inline-item">
                <a class="social-list-item bg-dark-subtle text-secondary fs-16 border-0" title=""
                    data-bs-toggle="tooltip" data-bs-placement="top" class="tooltips"
                    href="{{ $team_user->team->user->facebook }}" data-bs-title="Facebook"><i
                        class="ri-facebook-fill"></i></a>
            </li>
            <li class="list-inline-item">
                <a class="social-list-item bg-dark-subtle text-secondary fs-16 border-0" title=""
                    data-bs-toggle="tooltip" data-bs-placement="top" class="tooltips"
                    href="{{ $team_user->team->user->twitter }}" data-bs-title="Twitter"><i
                        class="ri-twitter-fill"></i></a>
            </li>
            <li class="list-inline-item">
                <a class="social-list-item bg-dark-subtle text-secondary fs-16 border-0" title=""
                    data-bs-toggle="tooltip" data-bs-placement="top" class="tooltips"
                    href="{{ $team_user->team->user->linkedin }}" data-bs-title="LinkedIn"><i
                        class="ri-linkedin-box-fill"></i></a>
            </li>
        </ul>
    </div>
    <!-- card-body -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title mt-2 p-2">{{ __('All people in the team.') }}</h4>
            </div>
            <div class="row">
                <div class="row">

                    @forelse ($team_user->team->teams()->whereNot('user_id', $id)->get() as $item)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="d-flex">
                                        <a class="me-3" href="#">

                                            <img class="avatar-md rounded-circle bx-s"
                                                src="{{ $item->image ? $item->image : asset('assets/admin/images/default/avatar-1.jpg') }}"
                                                alt="">
                                        </a>
                                        <div class="info">
                                            <h5 class="fs-18 my-1">{{ $item->name }}</h5>
                                            <p class="text-muted fs-15">{{ $item->email }}</p>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <ul class="social-list list-inline mt-3 mb-0">
                                    <li class="list-inline-item">
                                        <a class="social-list-item bg-dark-subtle text-secondary fs-16 border-0"
                                            title="" data-bs-toggle="tooltip" data-bs-placement="top" class="tooltips"
                                            href="{{ $item->facebook }}" data-bs-title="Facebook"><i
                                                class="ri-facebook-fill"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="social-list-item bg-dark-subtle text-secondary fs-16 border-0"
                                            title="" data-bs-toggle="tooltip" data-bs-placement="top" class="tooltips"
                                            href="{{ $item->twitter }}" data-bs-title="Twitter"><i
                                                class="ri-twitter-fill"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="social-list-item bg-dark-subtle text-secondary fs-16 border-0"
                                            title="" data-bs-toggle="tooltip" data-bs-placement="top" class="tooltips"
                                            href="{{ $item->linkedin }}" data-bs-title="LinkedIn"><i
                                                class="ri-linkedin-box-fill"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- card-body -->
                        </div>
                        <!-- card -->
                    </div>

                    @empty
                    @endforelse
                    <!-- end col -->
                    <!-- end col -->
                </div>

            </div>

        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
