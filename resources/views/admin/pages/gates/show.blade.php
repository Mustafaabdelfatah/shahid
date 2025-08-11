@extends('admin.dashboard')
@section('title', __('gates'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Show gates') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.gates.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-justified nav-bordered mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Info gates') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Attachments') }}
                        </a>
                    </li>
                    {{-- @if ($gates->relationLoaded('units') && $gates->units->isNotEmpty())

                        <li class="nav-item" role="presentation">
                            <a href="#units" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                                aria-selected="false" role="tab" tabindex="-1">
                                {{ __('Units') }}
                            </a>
                        </li>
                    @endif --}}


                </ul>

                <div class="tab-content">
                    <div class="tab-pane active show" id="home-b2" role="tabpanel">
                        <ul class="list-group">
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Title') }}</h5>
                                    {{ $gates->trans->where('locale', $current_lang)->first()->title }}
                                </div>

                                {{-- <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Units') }}</h5>
                                    {{ $gates-> }}
                                </div> --}}

                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Status') }}</h5>
                                    @if ($gates->status == 1)
                                        <span class="badge bg-primary">{{ __('Active') }}</span>
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
                                    <div class="col-md-12 m-1">
                                        <!-- Image -->
                                        @if ($gates->image)
                                            <img src="{{ asset($gates->image) }}" width="100%" class="img-fluid rounded" alt="...">
                                        @else
                                            <h1>no image here</h1>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{-- 
                    @if ($gates->relationLoaded('units') && $gates->units->isNotEmpty())
                        <div class="tab-pane" id="units" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($gates->units as $item)
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="card card-selectable" data-radio-id="unit-{{ $item->id }}">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="selected_unit" id="unit-{{ $item->id }}"
                                                        value="{{ $item->id }}">
                                                </div>
                                                <div style="height: 200px; overflow: hidden;">
                                                    <!-- Set a fixed height for the image container -->
                                                    <img src="{{ $item->images()->first()->image }}"
                                                        class="card-img-top card-img-custom" alt="...">
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><i
                                                                        class="ri-money-dollar-circle-line"></i>
                                                                    {{ __('Price') }}:
                                                                    {{ $item->price }}</li>
                                                                <li class="list-group-item"><i class="ri-coins-line"></i>
                                                                    {{ __('Service Charges') }}:
                                                                    {{ $item->service_charges }}</li>
                                                                <li class="list-group-item"><i class="ri-layout-5-line"></i>
                                                                    {{ __('Size') }}:
                                                                    {{ $item->size }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><i
                                                                        class="ri-checkbox-circle-line"></i>
                                                                    {{ __('Type') }}
                                                                    :
                                                                    {{ $item->type }}</li>
                                                                <li class="list-group-item"><i
                                                                        class="ri-hotel-bed-line"></i> {{ __('Rooms') }}:
                                                                    {{ $item->rooms }}</li>
                                                                <li class="list-group-item"><i class="ri-barcode-line"></i>
                                                                    {{ __('Code') }}:
                                                                    {{ $item->code }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><i
                                                                        class="ri-creative-commons-by-fill"></i>
                                                                    {{ __('Bathroom') }}:
                                                                    {{ $item->bathroom }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><i class="ri-stack-line"></i>
                                                                    Floor:
                                                                    {{ $item->floor }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><i
                                                                        class="ri-map-pin-user-line"></i>
                                                                    {{ __('Created By ') }}:

                                                                    <span
                                                                        class="fw-bold text-capitalize ">{{ $item->admin->name }}</span>
                                                                </li>
                                                                <li class="list-group-item"><i
                                                                        class="ri-map-pin-time-line"></i>
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
                    @endif --}}

                </div>


            </div> <!-- end card-body-->
        </div>
    </div>
@endsection
</div>
