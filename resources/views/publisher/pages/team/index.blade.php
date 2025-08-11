@extends('publisher.dashboard')
@section('title', __('Team'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('All Teams') }}</h4>
                <p class="text-muted fs-15">{{ __('You can manage all teams from here') }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="page-title">{{ __('Team name is :') }} {{ $team?->title }}</h4>
                    @include('layouts.admin.message')
                    @if (!$team)
                        <a href="{{ route('publisher.teams.create') }}"
                            class="btn btn-primary float-end m-1">{{ __('Create Team') }}</a>
                    @else
                        <a href="{{ route('publisher.teams.edit', $team->id) }}" class="btn btn-success float-end m-1">
                            <i class="ri-pencil-fill"></i> {{ __('Edit Team') }}
                        </a>
                    @endif
                    @if ($team)
                        <button type="button" class="btn btn-danger float-end m-1" data-bs-toggle="modal"
                            data-bs-target="#danger-header-modal{{ $team?->id }}" title="{{ __('Delete') }}"><i
                                class="ri-delete-bin-line"></i>{{ __('Delete Team') }}</button>
                        @include('publisher.pages.team._model_delete')
                    @endif

                </div>
                <div class="row">
                    @forelse (@$team->teams ?? [] as $item)
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
                                                <p class="text-muted fs-15">Email : {{ $item->email }}</p>
                                                <p class="text-muted fs-15">Phone : {{ $item->phone }}</p>
                                                <a href="{{ route('publisher.teams.employee_projects', $item->id) }}"
                                                    class="btn btn-primary btn-sm">{{ __('View Units')}}</a>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>

                                        </div>
                                    </div>
                                    <hr>

                                </div>
                                <!-- card-body -->
                            </div>
                            <!-- card -->
                        </div>
                        @include('publisher.pages.team.model_delete_teams')
                    @empty
                    @endforelse
                    <!-- end col -->
                    <!-- end col -->
                </div>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
