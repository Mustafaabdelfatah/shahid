@extends('publisher.dashboard')
@section('title', __('Units'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Show Units') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('publisher.units.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-justified nav-bordered mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Info Product') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
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
                    {{-- <li class="nav-item" role="presentation">
                        <a href="#package" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="false"
                            role="tab" tabindex="-1">
                            {{ __('Package Info') }}
                        </a>
                    </li> --}}
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active show" id="home-b2" role="tabpanel">
                        <ul class="list-group">
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Title') }}</h5>
                                    {{ $unit->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Description') }}</h5>
                                    {!! $unit->trans->where('locale', $current_lang)->first()->description !!}
                                </div>
                            </div>
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Price') }}</h5>
                                    {{ $unit->price }}
                                </div>
                                {{-- <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Service Charges') }}</h5>
                                    {!! $unit->service_charges !!}
                                </div> --}}
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Space') }}</h5>
                                    {{ $unit->size }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Unit Code') }}</h5>
                                    {{ $unit->code }}
                                </div>
                                {{-- <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('gates') }}</h5>
                                    {!! $unit->gates !!}
                                </div> --}}
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Rooms') }}</h5>
                                    {{ $unit->rooms }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Bathroom') }}</h5>
                                    {!! $unit->bathroom !!}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Floor') }}</h5>
                                    {{ $unit->floor }}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Gates') }}</h5>
                                    @if($unit->gates->isNotEmpty())
                                        <ul>
                                            @foreach($unit->gates as $gate)
                                                <li>{{ $gate->title }}</li> <!-- Adjust the attribute name to what you have in your Gates model -->
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>{{ __('No gates assigned.') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Location') }}</h5>
                                    {{ $unit->location }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Type') }}</h5>
                                    {!! $unit->type !!}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('paying') }}</h5>
                                    {!! $unit->paying !!}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Furnished') }}</h5>
                                    {{$unit->Furnished}}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Finishing type') }}</h5>
                                    {{$unit->Finishing_type}}
                                </div>
                                {{-- <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Country') }}</h5>
                                    {{ $unit->country->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('State') }}</h5>
                                    {!! $unit->state->trans->where('locale', $current_lang)->first()->title !!}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('City') }}</h5>
                                    {{ $unit->city->trans->where('locale', $current_lang)->first()->title }}
                                </div> --}}
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('District') }}</h5>
                                    {!! $unit->district->trans->where('locale', $current_lang)->first()->title !!}
                                </div>

                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Status') }}</h5>
                                    @if ($unit->status == 1)
                                        <span class="badge bg-primary">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Feature') }}</h5>
                                    @if ($unit->feature == 1)
                                        <span class="badge bg-primary">{{ __('Feature') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </div> --}}
                            </div>
                        </ul>
                        </ul>
                    </div>
                    <div class="tab-pane" id="profile-b2" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                @if ($unit->plan)
                                    <h3 style="text-align: center;">{{ __('Cover Photo') }}</h3>
                                    <hr>
                                    <div class="mt-3 center col-md-12 text-center">
                                        <img class="d-block img-fluid mx-auto" src="{{ $unit->plan }}" alt="plan">
                                    </div>
                                @endif
                                <h3 style="text-align: center;" class="mt-3">{{ __('Units Photos') }}</h3>
                                <hr>
                                @foreach ($unit->images as $item)
                                <div class="mt-3 col-lg-4 d-flex justify-content-center">
                                    <img class="d-block img-fluid" src="{{ $item->image }}" alt="First slide">
                                </div>
                                @endforeach
                                @if ($unit->video_unit)
                                    <h3 style="text-align: center;">{{ __('Video') }}</h3>
                                    <hr>
                                    <div class="mt-1 mb-3 col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <video width="100%" height="440" controls>
                                                <source src="{{ asset($unit->video_unit) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                @endif
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
                                                    @foreach ($unit->property as $key => $item)
                                                        <div class="col-md-3">

                                                            <div class="form-check form-check-success">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="{{ $item->id }}"
                                                                    id="flexCheckSuccess{{ $key }}"
                                                                    name=""
                                                                    {{ $unit->property->contains('id', $item->id) ? 'checked' : '' }}
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

                        </div>
                    </div>
                    <div class="tab-pane" id="package" role="tabpanel">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="row">
                                                    @foreach ($unit->datePackageProduct as $key => $item)
                                                        <ul class="list-group">
                                                            <div class="row  d-flex  justify-content-center">
                                                                <div class="col-md-3 list-group-item m-1">
                                                                    <h5 class="text-success">{{ __('Package Name') }}</h5>
                                                                    {{ $item->package->trans->where('locale', $current_lang)->first()->title }}
                                                                </div>
                                                                <div class="col-md-3 list-group-item m-1">
                                                                    <h5 class="text-success">
                                                                        {{ __('Package Description') }}
                                                                    </h5>
                                                                    {{ $item->package->trans->where('locale', $current_lang)->first()->description }}
                                                                </div>
                                                                <div class="col-md-3 list-group-item m-1">
                                                                    <h5 class="text-success">{{ __('Package Days') }}
                                                                    </h5>
                                                                    {{ $item->date->duration }} Day
                                                                </div>
                                                                <div class="col-md-3 list-group-item m-1">
                                                                    <h5 class="text-success">{{ __('Package Price') }}
                                                                    </h5>
                                                                    {{ $item->date->price }}
                                                                </div>
                                                                <div class="col-md-3 list-group-item m-1">
                                                                    <h5 class="text-success">{{ __('Start Data') }}</h5>
                                                                    {{ $item->start_date }}
                                                                </div>
                                                                <div class="col-md-3 list-group-item m-1">
                                                                    <h5 class="text-success">{{ __('End Data') }}</h5>
                                                                    {{ $item->end_date }}
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div> <!-- end card-body-->
                    </form>

                </div>
            </div>
        @endsection
