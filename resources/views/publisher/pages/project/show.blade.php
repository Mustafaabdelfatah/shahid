@extends('publisher.dashboard')
@section('title', __('projects'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Show projects') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('publisher.projects.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-justified nav-bordered mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Info projects') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Attachments') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Units') }}
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active show" id="home-b2" role="tabpanel">
                        <ul class="list-group">
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Title') }}</h5>
                                    {{ $project->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Description') }}</h5>
                                    {!! $project->trans->where('locale', $current_lang)->first()->description !!}
                                </div>
                            </div>
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Location') }}</h5>
                                    {{ $project->address }}
                                </div>
                                {{-- <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Units') }}</h5>
                                    {{ $project-> }}
                                </div> --}}
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Country') }}</h5>
                                    {{ $project->country->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('State') }}</h5>
                                    {!! $project->state->trans->where('locale', $current_lang)->first()->title !!}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('City') }}</h5>
                                    {{ $project->city->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('District') }}</h5>
                                    {!! $project->district->trans->where('locale', $current_lang)->first()->title !!}
                                </div>

                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Status') }}</h5>
                                    @if ($project->status == 1)
                                        <span class="badge bg-primary">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Feature') }}</h5>
                                    @if ($project->feature == 1)
                                        <span class="badge bg-primary">{{ __('Feature') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </div>
                            </div>
                        </ul>
                        </ul>
                    </div>
                    <div class="tab-pane" id="profile-b2" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <div class="row g-0 align-items-center col-md-12">
                                    <div class=" row align-items-center mb-2">
                                        <div class="col-md-3 m-1" style="position: relative;">
                                            <!-- Delete Icon -->
                                            <!-- Image -->
                                            <img src="{{ asset($project->image) }}" class="img-fluid rounded-start"
                                                alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div> <!-- end card-body-->
            </div>
        </div>
    @endsection
</div>
