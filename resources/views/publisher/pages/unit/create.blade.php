@extends('publisher.dashboard')
@section('title', __('Units'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Create Unit') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            @include('layouts.admin.message')
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('publisher.units.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('publisher.units.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                                {{ __('Title') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingOne" style>
                                            <div class="accordion-body">
                                                @foreach ($languages as $index => $locale)
                                                    {{-- title
                                            -------------------------------------------------------------------------------------
                                            --}}
                                                    <div class="mb-3 row">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="title{{ $index }}">{{ __('Title in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control" type="text"
                                                                name="{{ $locale }}[title]"
                                                                value="{{ old($locale . '.title') }}"
                                                                id="title{{ $index }}" required>
                                                            @if ($errors->has($locale . '.title'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="description{{ $index }}">
                                                                {{ __('Description in ') . Illuminate\Support\Facades\Lang::get($locale) }}
                                                            </label>
                                                            <textarea name="{{ $locale }}[description]"
                                                                      id="description{{ $index }}"
                                                                      class="form-control"
                                                                      required
                                                                      maxlength="5000"
                                                                      oninput="updateCharCount(this, {{ $index }})"
                                                                      cols="3"
                                                                      rows="10">{{ old($locale . '.description') }}</textarea>
                                                            <div class="d-flex justify-content-between">
                                                                <small class="text-muted">Max length: 5000</small>
                                                                <small class="text-muted"><span id="charCount{{ $index }}">0</span>/5000</small>
                                                            </div>
                                                            @if ($errors->has($locale . '.description'))
                                                                <span class="text-danger">{{ $errors->first($locale . '.description') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                                {{ __('Setting Units') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="plan">{{ __('Cover Photo') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" class="form-control" id="plan"
                                                                name="plan">
                                                            @error('plan')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="image">{{ __('Images') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" class="form-control" id="image"
                                                                name="image[]" multiple>
                                                            @error('image.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="video">{{ __('Video') }}</label>
                                                            <input type="file" class="form-control" id="video"
                                                                name="video_unit" value="{{ old('video') }}">
                                                            @error('video_unit')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="type">{{ __('Type Unit') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control" id="type" name="type">
                                                                <option>{{ __('Select Unit') }}</option>
                                                                <option value="rent">{{ __('Rent') }}</option>
                                                                <option value="sale">{{ __('Sale') }}</option>
                                                            </select>
                                                            @error('type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="paying">{{ __('Unit Payment Method') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control" id="paying" name="paying">
                                                                <option>{{ __('Select Method') }}</option>
                                                                <option value="Installment">{{ __('Installment') }}
                                                                </option>
                                                                <option value="cash">{{ __('cash') }}</option>
                                                            </select>
                                                            @error('paying')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="Furnished">{{ __('Furnished') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control" id="Furnished" name="Furnished">
                                                                <option>{{ __('Select Method') }}</option>
                                                                <option value="Furnished">{{ __('Furnished') }}
                                                                </option>
                                                                <option value="Unfurnished">{{ __('Unfurnished') }}</option>
                                                            </select>
                                                            @error('Furnished')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="Finishing_type">{{ __('Finishing type') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control" id="Finishing_type" name="Finishing_type">
                                                                <option>{{ __('Select Method') }}</option>
                                                                <option value="red_bricks">{{ __('Red Bricks') }}</option>
                                                                <option value="finishing_text">{{ __('Finishing text') }}</option>
                                                                <option value="super_deluxe">{{ __('Super deluxe') }}</option>
                                                                <option value="lux">{{ __('Lux') }}</option>
                                                            </select>
                                                            @error('Finishing_type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="select2-multiple">{{ __('Categories') }}<span
                                                                    class="text-danger">*</span></label>
                                                            {{-- //onchange={(e)=>value = e.target.value} --}}
                                                            <select required class=" form-control" id="select2-multiple"
                                                                name="category_id"
                                                                data-placeholder="{{ __('Choose Catgerory') }} ...">
                                                                <option>{{ __('Select Catgerory') }}</option>
                                                                @foreach ($categories as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ @$item->trans->where('locale', $current_lang)->first()->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="select2-multiple">{{ __('Projects') }}</label>
                                                            <select class=" form-control" name="project_id">
                                                                @foreach ($projects as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ @$item->trans->where('locale', $current_lang)->first()->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('project_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}


                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="price">{{ __('Price') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="price"
                                                                name="price" value="{{ old('price') }}" required>
                                                            @error('price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="service_charges">{{ __('Service Charges') }}</label>
                                                            <input type="number" class="form-control"
                                                                id="service_charges" name="service_charges"
                                                                value="{{ old('service_charges') }}">
                                                            @error('service_charges')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="size">{{ __('Space') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="size"
                                                                name="size" value="{{ old('size') }}" required>
                                                            @error('size')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="rooms">{{ __('Rooms') }}</label>
                                                            <input type="number" class="form-control" id="rooms"
                                                                name="rooms" value="{{ old('rooms') }}" required>
                                                            @error('rooms')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="bathroom">{{ __('Bathroom') }}</label>
                                                            <input type="number" class="form-control" id="bathroom"
                                                                name="bathroom" value="{{ old('bathroom') }}" required>
                                                            @error('bathroom')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="floor">{{ __('Floor') }}</label>
                                                            <input type="number" class="form-control" id="floor"
                                                                name="floor" value="{{ old('floor') }}" required>
                                                            @error('floor')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="code">{{ __('Unit Code') }}</label>
                                                            <input type="text" class="form-control" id="code"
                                                                name="code" value="{{ old('code') }}" required>
                                                            @error('code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="location">{{ __('Location') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="location"
                                                                name="location" value="{{ old('location') }}" required>
                                                            @error('location')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="select2Multiple"
                                                            class="form-label">{{ __('District') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select required class="form-control w-100" id="select2Multiple"
                                                            name="district_id">
                                                            <option>{{ __('Select District') }}</option>
                                                            @if (@$districts)
                                                                @foreach ($districts as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ @$item->trans->where('locale', $current_lang)->first()->title }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('district_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- @livewire('select-country-product') --}}
                                                    <div class="col-sm-12">
                                                        <div class="mt-2 accordion" id="accordionPanelsStayOpenExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header"
                                                                    id="gates-accordion-header">
                                                                    <button class="accordion-button fw-medium collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#gates-accordion-content"
                                                                        aria-expanded="false"
                                                                        aria-controls="gates-accordion-content">
                                                                        {{ __('Gates') }}
                                                                    </button>
                                                                </h2>
                                                                <div id="gates-accordion-content"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="gates-accordion-header">
                                                                    <div class="accordion-body">
                                                                        <div class="mb-3">

                                                                            <div class="row">
                                                                                @foreach ($gates as $item)
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input"
                                                                                                type="checkbox"
                                                                                                value="{{ $item->id }}"
                                                                                                id="gates-{{ $item->id }}"
                                                                                                name="gates[]">
                                                                                            <label class="form-check-label"
                                                                                                for="gates-{{ $item->id }}">
                                                                                                {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('gates')
                                                                    <span
                                                                        class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                                @enderror
                                                                @error('gates.*')
                                                                    <span
                                                                        class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="mt-2 accordion" id="accordionPanelsStayOpenExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header"
                                                                    id="property-accordion-header">
                                                                    <button class="accordion-button fw-medium collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#property-accordion-content"
                                                                        aria-expanded="false"
                                                                        aria-controls="property-accordion-content">
                                                                        {{ __('Facilities') }}
                                                                    </button>
                                                                </h2>
                                                                <div id="property-accordion-content"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="property-accordion-header">
                                                                    <div class="accordion-body">
                                                                        <div class="mb-3">

                                                                            <div class="row">
                                                                                @foreach ($propertys as $item)
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input"
                                                                                                type="checkbox"
                                                                                                value="{{ $item->id }}"
                                                                                                id="property-{{ $item->id }}"
                                                                                                name="properties[]">
                                                                                            <label class="form-check-label"
                                                                                                for="property-{{ $item->id }}">
                                                                                                {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('properties')
                                                                    <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                                @enderror
                                                                @error('properties.*')
                                                                    <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    {{-- <div class="mt-3 col-sm-12">
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck3" name="approve">
                                                            <label class="form-check-label"
                                                                for="customCheck3">{{ __('Approve') }}</label>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-wrap gap-2 p-2 mt-1 d-flex float-end">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>

                <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
    <!-- Multi Select Plugin Js -->
    <script>
        function updateCharCount(textarea, index) {
            var charCount = textarea.value.length;
            var charCountSpan = document.getElementById('charCount' + index);
            charCountSpan.textContent = charCount;
        }

        // Initialize the char count on page load
        document.addEventListener('DOMContentLoaded', function() {
            var textareas = document.querySelectorAll('textarea');
            textareas.forEach(function(textarea, index) {
                updateCharCount(textarea, index);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the category select element
            var categorySelect = document.getElementById('select2-multiple');
            // Get the input fields to hide/show
            var toggleContent = document.getElementById('toggle-content');
            // Add event listener to category select
            categorySelect.addEventListener('change', function() {
                // Check if the selected category is "land" (assuming its value is "land")
                if (categorySelect.value == 3) {
                    // If "land" is selected, hide the rooms input
                    toggleContent.style.display = 'none';
                } else {
                    // If any other category is selected, show the rooms input
                    toggleContent.style.display = 'block';
                }
                // Add similar conditions for other input fields
            });
        });
    </script>
@endsection
