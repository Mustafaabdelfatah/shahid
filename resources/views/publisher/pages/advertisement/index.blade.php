@extends('publisher.dashboard')
@section('title', __('Sponsored Advertisement'))
@section('style')
    <style>
        .card-selectable {
            cursor: pointer;
            position: relative;
            height: 400px;
            /* Set a fixed height for the card */
        }

        .form-check {
            position: absolute;
            top: 10px;
            /* Adjust as needed */
            left: 10px;
            /* Adjust as needed */
        }

        .card-img-custom {
            height: 100%;
            /* Fill the entire height of the card */
            object-fit: cover;
            /* Ensures the image covers the entire area */
            width: 100%;
            /* Ensures the image fits the width of the card */
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Sponsored Advertisement') }}</h4>
            </div>
        </div>
    </div>
    @include('layouts.admin.message')
    <div class="row">
        @foreach ($units as $item)
            <div class="col-sm-6 col-lg-4">
                <div class="card card-selectable" data-radio-id="unit-{{ $item->id }}">
                    {{-- <div class="form-check">
                        <input class="form-check-input" type="radio" name="selected_unit" id="unit-{{ $item->id }}"
                            value="{{ $item->id }}">
                    </div> --}}
                    <div style="height: 200px; overflow: hidden;"> <!-- Set a fixed height for the image container -->
                        <img src="{{ $item->images()->first()->image }}" class="card-img-top card-img-custom"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->trans->where('locale', $current_lang)->first()->title }}</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="ri-money-dollar-circle-line"></i> {{ __('Price') }}:
                                        {{ $item->price }}</li>
                                    <li class="list-group-item"><i class="ri-coins-line"></i> {{ __('Service Charges') }}:
                                        {{ $item->service_charges }}</li>
                                    <li class="list-group-item"><i class="ri-layout-5-line"></i> {{ __('Size') }}:
                                        {{ $item->size }}</li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="ri-checkbox-circle-line"></i> {{ __('Type') }} :
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
                                    <li class="list-group-item"><i class="ri-creative-commons-by-fill"></i> {{ __('Bathroom') }}:
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
                                    <li class="list-group-item"><i class="ri-map-pin-user-line"></i> {{ __('Created By ') }}:

                                        <span class="fw-bold text-capitalize ">{{ $item->user->name }}</span>
                                    </li>
                                    <li class="list-group-item"><i class="ri-map-pin-time-line"></i> {{ __('Created At ') }}:
                                        <small
                                            class="fw-normal text-muted float-end ms-1">{{ $item->created_at->diffForHumans() }}</small>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('publisher.package.choose_package', $item->id) }}"
                            class="btn btn-primary mt-2 stretched-link">{{ __('choose package') }}</a>
                    </div>
                    <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-->
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-selectable');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    const radioId = this.getAttribute('data-radio-id');
                    const radioInput = document.getElementById(radioId);
                    radioInput.checked = true;
                });
            });
        });
    </script>
@endsection
