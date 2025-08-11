@extends('admin.dashboard')
@section('title', __('Buildings'))
@section('content')
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.buildings.index') }}">{{ __('Buildings') }}</a>
                        </li>
                    </li>
                        <li class="breadcrumb-item active text-info">{{ __('Show Project') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('Buildings') }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-justified nav-bordered mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Info buildings') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Type Units') }}
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="#profile-b3" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Attachments') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#propertys-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Facilities') }}
                        </a>
                    </li>
                    @if ($project->relationLoaded('units') && $project->units->isNotEmpty())

                        <li class="nav-item" role="presentation">
                            <a href="#units" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                                aria-selected="false" role="tab" tabindex="-1">
                                {{ __('Units') }}
                            </a>
                        </li>
                    @endif


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
                                    <h5 class="text-success">{{ __('Address') }}</h5>
                                    {{ $project->address }}
                                </div>

                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Status') }}</h5>
                                    @if ($project->status == 1)
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
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            {{-- <a href="{{ route('admin.prices.create',) }}" class="btn btn-primary float-end">{{
                                                __('Create') }}</a> --}}
                                        </div>
                                        <div class="card-body">
                                            {{-- <form id="update-pages" action="{{ route('admin.prices.actions') }}" method="post">
                                                @csrf
                                            </form> --}}
                                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('Title In En') }}</th>
                                                        <th>{{ __('Title In Ar') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($project->type_units as $item)
                                                        <tr>
                                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                                            <td>{{ $item->trans->where('locale', 'en')->first()->title }}</td>
                                                            <td>{{ $item->trans->where('locale', 'ar')->first()->title }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">{{ __('No Type Units found') }}</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div> <!-- end card body-->
                                    </div> <!-- end card -->
                                </div><!-- end col-->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="profile-b3" role="tabpanel">
                        <div class="card-body">
                            <div class="row g-0 align-items-center col-md-12">
                                @foreach ($project->attachments as $item)
                                    <div class="mb-1 row align-items-center col-md-6">
                                        <img src="{{ asset($item->image) }}"
                                        width="200"
                                        class="img-fluid rounded-start"
                                        alt="...">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="propertys-b2" role="tabpanel">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="row">
                                                    @foreach ($project->property as $key => $item)
                                                        <div class="col-md-3">

                                                            <div class="form-check form-check-success">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="{{ $item->id }}"
                                                                    id="flexCheckSuccess{{ $key }}"
                                                                    name=""
                                                                    {{ $project->property->contains('id', $item->id) ? 'checked' : '' }}
                                                                    disabled>
                                                                <label class="form-check-label"
                                                                    for="flexCheckSuccess{{ $key }}">
                                                                    {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>

                    </div>
                    @if ($project->relationLoaded('units') && $project->units->isNotEmpty())
                        <div class="tab-pane" id="units" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($project->units as $item)
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
                </div> <!-- end card-body-->
            </div>
        </div>
    @endsection
</div>
