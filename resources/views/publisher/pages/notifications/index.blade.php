@extends('publisher.dashboard')
@section('title', __('Notifications Details'))
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Dismissing Alerts</h4>
            <p class="text-muted fs-14 mb-3">
                Add a dismiss button and the <code>.alert-dismissible</code> class, which adds
                extra padding to the right of the alert
                and positions the <code>.btn-close</code> button.
            </p>
            @foreach (Auth::user()->notifications as $notification)
            <a href="#"
                class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none @if ($notification->read_at === null) bg-light  @else bg-white @endif">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="notify-icon">
                                <img src="{{ $setting_dashboard->image_sm_light_mode ? $setting_dashboard->image_sm_light_mode : asset('assets/admin/images/logo-sm.png') }}"
                                    alt="logo" width="50">
                            </div>
                        </div>
                        <div class="flex-grow-1 text-truncate ms-2">
                            <h5 class="noti-item-title fw-semibold fs-14">
                                {{ @$notification->data['title'] }}
                                {{ @$notification->data['product_title'] }}

                                <small
                                    class="fw-normal text-muted float-end ms-1">{{ $notification->created_at->diffForHumans() }}</small>
                            </h5>
                            <small
                                class="noti-item-subtitle text-muted">{{ $notification->data['message'] }}</small>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
            <div class="alert alert-primary alert-dismissible text-bg-primary border-0 fade show"
                role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Primary - </strong> A simple primary alert—check it out!
            </div>
            <div class="alert alert-secondary alert-dismissible text-bg-secondary border-0 fade show"
                role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Secondary - </strong> A simple secondary alert—check it out!
            </div>
            <div class="alert alert-success alert-dismissible text-bg-success border-0 fade show"
                role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> A simple success alert—check it out!
            </div>
            <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show"
                role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error - </strong> A simple danger alert—check it out!
            </div>
            <div class="alert alert-warning alert-dismissible text-bg-warning border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Warning - </strong> A simple warning alert—check it out!
            </div>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Info - </strong> A simple info alert—check it out!
            </div>
            <div class="alert alert-pink alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Pink - </strong> A simple pink alert—check it out!
            </div>
            <div class="alert alert-purple alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Purple - </strong> A simple purple alert—check it out!
            </div>
            <div class="alert alert-light alert-dismissible text-dark fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Light - </strong> A simple light alert—check it out!
            </div>
            <div class="alert alert-dark alert-dismissible fade show mb-0" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Dark - </strong> A simple dark alert—check it out!
            </div>

        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div> <!-- end col-->



@endsection
