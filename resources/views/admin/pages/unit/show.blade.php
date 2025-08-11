@extends('admin.dashboard')
@section('title', __('Units'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Show Unit') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.units.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <ul class="mb-3 nav nav-tabs nav-justified nav-bordered" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Info Unit') }}
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
                    @if ($unit->user_id != null)

                        @if ($unit->status == 0)
                            <li class="nav-item" role="presentation">
                                <a href="#rejected-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link"
                                    aria-selected="false" role="tab" tabindex="-1">
                                    {{ __('rejected Unit') }}
                                </a>
                            </li>
                        @endif

                    @endif
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active show" id="home-b2" role="tabpanel">
                        <ul class="list-group">
                            <div class="row d-flex justify-content-center">
                                <div class="m-1 col-md-4 list-group-item">
                                    <h5 class="text-success">{{ __('Title') }}</h5>
                                    {{ $unit->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="m-1 col-md-4 list-group-item">
                                    <h5 class="text-success">{{ __('Description') }}</h5>
                                    {!! $unit->trans->where('locale', $current_lang)->first()->description !!}
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Price') }}</h5>
                                    <td>{{ number_format($unit->price, 0, '', ',') }}</td>
                                    </div>
                                {{-- <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Service Charges') }}</h5>
                                    {!! $unit->service_charges !!}
                                </div> --}}
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Space') }}</h5>
                                    {{ $unit->size }}
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
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Furnished') }}</h5>
                                    {{$unit->Furnished}}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Finishing Type') }}</h5>
                                    {{$unit->Finishing_type}}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Main Category') }}</h5>
                                    {{$unit->main_category}}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Rooms') }}</h5>
                                    {{ $unit->rooms }}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Bathroom') }}</h5>
                                    {!! $unit->bathroom !!}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Floor') }}</h5>
                                    {{ $unit->floor }}
                                </div>
                                {{-- <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Feature') }}</h5>
                                    {!! $unit->feature !!}
                                </div> --}}
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Location') }}</h5>
                                    {{ $unit->location }}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Type') }}</h5>
                                    {!! $unit->type !!}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Payment Method') }}</h5>
                                    {!! $unit->paying !!}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Unit Code') }}</h5>
                                    {{ $unit->code }}
                                </div>
                                {{-- <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Country') }}</h5>
                                    {{ @$unit->country->trans->where('locale', $current_lang)->first()->title }}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('State') }}</h5>
                                    {!! @$unit->state->trans->where('locale', $current_lang)->first()->title !!}
                                </div>
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('City') }}</h5>
                                    {{ @$unit->city->trans->where('locale', $current_lang)->first()->title }}
                                </div> --}}
                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('District') }}</h5>
                                    @if ($unit->district)
                                        @php
                                            $districtTitle = optional(
                                                $unit->district->trans()->where('locale', $current_lang)->first(),
                                            )->title;
                                        @endphp
                                        @if ($districtTitle)
                                            {{ $districtTitle }}
                                        @else
                                            <p>No title available for the district in the current language.</p>
                                        @endif
                                    @else
                                        <p></p>
                                    @endif
                                </div>

                                <div class="m-1 col-md-3 list-group-item">
                                    <h5 class="text-success">{{ __('Status') }}</h5>
                                    @if ($unit->status == 1)
                                        <span class="badge bg-primary">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="m-1 col-md-3 list-group-item">
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
                            </form>

                        </div>

                    </div>
                    <div class="tab-pane" id="rejected-b2" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('admin.product.rejected') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $unit->user_id }}" name="user_id">
                                    <input type="hidden" value="{{ $unit->id }}" name="product_id">
                                    @foreach ($languages as $index => $locale)
                                        <div class="mb-3 row d-flex justify-content-between">
                                            <div class="mb-3 col-12">
                                                <label class="form-label"
                                                    for="message{{ $index }}">{{ __('Reason in ') . Locale::getDisplayName($locale) }}</label>
                                                <textarea class="form-control" name="{{ $locale }}[message]" id="message{{ $index }}">{{ old($locale . '.message') }}</textarea>
                                                @if ($errors->has($locale . '.message'))
                                                    <span
                                                        class="text-danger">{{ $errors->first($locale . '.message') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                            <div class="flex-wrap gap-2 p-2 mt-1 d-flex float-end">
                                <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                            </div>
                        </div>
                        </form>
                        {{-- @endif --}}

                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>
    @endsection
</div>
