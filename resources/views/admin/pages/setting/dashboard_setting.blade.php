@extends('admin.dashboard')
@section('title', __('Settings'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class=" page-title">{{ __('Setting Dashboard') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Upload Images</h5>
                        <form action="{{ route('admin.setting.dashboard.update', $setting->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Main Image (Light Mode) -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="image_main_light_mode">{{ __('Main Image Light Mode') }}</label>
                                        <input type="file" class="form-control" id="image_main_light_mode"
                                            name="image_main_light_mode" value="{{ old('image_main_light_mode') }}">
                                        @error('image_main_light_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($setting->image_main_light_mode)
                                        <img src="{{ asset($setting->image_main_light_mode) }}" width="200">
                                    @endif
                                </div>

                                <!-- Small Image (Light Mode) -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="image_sm_light_mode">{{ __('Small Image Light Mode') }}</label>
                                        <input type="file" class="form-control" id="image_sm_light_mode"
                                            name="image_sm_light_mode" value="{{ old('image_sm_light_mode') }}">
                                        @error('image_sm_light_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($setting->image_sm_light_mode)
                                        <img src="{{ asset($setting->image_sm_light_mode) }}" width="200">
                                    @endif
                                </div>

                                <!-- Main Image (Dark Mode) -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="image_main_dark_mode">{{ __('Main Image Dark Mode') }}</label>
                                        <input type="file" class="form-control" id="image_main_dark_mode"
                                            name="image_main_dark_mode" value="{{ old('image_main_dark_mode') }}">
                                        @error('image_main_dark_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($setting->image_main_dark_mode)
                                        <img src="{{ asset($setting->image_main_dark_mode) }}" width="200">
                                    @endif
                                </div>

                                <!-- Small Image (Dark Mode) -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="image_sm_dark_mode">{{ __('Small Image Dark Mode') }}</label>
                                        <input type="file" class="form-control" id="image_sm_dark_mode"
                                            name="image_sm_dark_mode" value="{{ old('image_sm_dark_mode') }}">
                                        @error('image_sm_dark_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($setting->image_sm_dark_mode)
                                        <img src="{{ asset($setting->image_sm_dark_mode) }}" width="200">
                                    @endif
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mt-2">{{ __('Edit') }}</button>
                        </form>
                    </div>
                </div>


                <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection
@section('script')


@endsection
