@extends('admin.dashboard')
@section('title', __('Edit Building'))
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.buildings.index') }}">{{ __('Building') }}</a>
                    </li>
                    <li class="breadcrumb-item active text-info">{{ __('Edit Building') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('Building') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <div class="d-flex justify-content-center">
                    <a href="{{ route('admin.type-units.create', $project->id) }}" class="btn btn-success mx-1">
                        <i class="ri-community-line"></i> {{ __('Type Unit') }}
                    </a>
                    @if ($project->method_payment == 'installment' || $project->method_payment == 'cash_and_insatllment')
                    <a href="{{ route('admin.buildings_installments.create', $project->id) }}" class="btn btn-info mx-1">
                        <i class="ri-pages-fill"></i> {{ __('Add Installment') }}
                    </a>
                    @endif
                </div>
            </div>
            <form action="{{ route('admin.buildings.update', $project->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- currentPage -->
                        <input type="hidden" name="page" value="{{ $currentPage }}">
                        <!-- currentPage -->
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
                                            <div class="row mb-3">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="title{{ $index }}">{{ __('Title in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="{{ $locale }}[title]"
                                                        value="{{ old($locale . '.title', optional($project->trans()->where('locale', $locale)->first())->title) }}"
                                                        id="title{{ $index }}">
                                                    @if ($errors->has($locale . '.title'))
                                                    <span
                                                        class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label"
                                                    for="title{{ $index }}">{{ __('description in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-12 mb-2">
                                                    <textarea id="description{{ $index }}"
                                                        name="{{ $locale }}[description]"> {{ old($locale . '.description', optional($project->trans()->where('locale', $locale)->first())->description) }} </textarea>
                                                    @if ($errors->has($locale . '.description'))
                                                    <span
                                                        class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                    @endif
                                                </div>

                                                <script type="text/javascript">
                                                    CKEDITOR.replace('description{{ $index }}', {
                                                        filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                                                        filebrowserUploadMethod: 'form'
                                                    });
                                                </script>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                                    aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                                    {{ __('Setting portfolios') }}
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                                aria-labelledby="panelsStayOpen-headingTwo" style>
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="cover">{{ __('Cover') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control" id="cover"
                                                                    name="cover">
                                                                @if ($errors->has('cover'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('cover') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="image">{{ __('Images') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control" id="image"
                                                                    name="image[]" multiple>
                                                                @if ($errors->has('image'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('image') }}</span>
                                                                @endif

                                                                @foreach ($errors->get('image.*') as $messages)
                                                                @foreach ($messages as $message)
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="user_id">{{ __('Developer name') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="user_id" id="user_id"
                                                                    class=" form-control">
                                                                    <option value="">{{ __('Select Developer') }}
                                                                    </option>
                                                                    @foreach ($users as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @selected(old('user_id', $item->id) == $project->user_id)>
                                                                        {{ $item->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('user_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="address">{{ __('Address') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="address"
                                                                    name="address"
                                                                    value="{{ old('address', $project->address) }}">
                                                                @error('address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">

                                                                <label class="form-label"
                                                                    for="delivery_date">{{ __('Delivery Date') }}<span
                                                                        class="text-danger">*</span></label>

                                                                <select name="delivery_date" id="delivery_date"
                                                                    class="form-control">
                                                                    <option value="">{{ __('Delivery Year') }}</option>
                                                                    @for ($year = now()->year; $year <= now()->year + 15; $year++)
                                                                        <option value="{{ $year }}"
                                                                            {{ old('delivery_date', $product->delivery_date ?? '') == $year ? 'selected' : '' }}>
                                                                            {{ $year }}
                                                                        </option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="delivery_date">{{ __('price') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="price"
                                                                    name="price"
                                                                    value="{{ old('price', $project->price) }}">
                                                                @error('price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="delivery_date">{{ __('spaces') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="spaces" name="spaces"
                                                                    value="{{ old('spaces', $project->spaces) }}">
                                                                @error('spaces')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="map">{{ __('Map') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="map"
                                                                    name="map" value="{{ old('price', $project->map) }}">
                                                                @error('map')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="method_payment">{{ __('Method Payment') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="method_payment" id="method_payment"
                                                                    class=" form-control">
                                                                    <option value="">
                                                                        {{ __('Select Method Payment') }}
                                                                    </option>
                                                                    <option value="cash_money"
                                                                        @selected(old('method_payment', $project->method_payment) == 'cash_money')>
                                                                        {{ __('Cash Money') }}
                                                                    </option>
                                                                    <option value="installment"
                                                                        @selected(old('method_payment', $project->method_payment) == 'installment')>
                                                                        {{ __('Installment') }}
                                                                    </option>
                                                                    <option value="cash_and_insatllment"
                                                                        @selected(old('method_payment', $project->method_payment) == 'cash_and_insatllment')>
                                                                        {{ __('Cash And Insatllment') }}
                                                                    </option>
                                                                </select>
                                                                @error('method_payment')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="construction_status">{{ __('Construction Status') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="construction_status"
                                                                    id="construction_status" class=" form-control">
                                                                    <option value="">
                                                                        {{ __('Select Construction Status') }}
                                                                    </option>
                                                                    <option value="under_construction"
                                                                        @selected(old('construction_status', $project->construction_status) == 'under_construction')>
                                                                        {{ __('Under Construction') }}
                                                                    </option>
                                                                    <option value="sent_delivered"
                                                                        @selected(old('construction_status', $project->construction_status) == 'sent_delivered')>
                                                                        {{ __('Completed') }}
                                                                    </option>
                                                                </select>
                                                                @error('construction_status')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="finish_type">{{ __('Finish Type') }}</label>
                                                                <select class=" form-control" id="finish_type"
                                                                    name="finish_type">
                                                                    <option>{{ __('Select Method') }}</option>
                                                                    <option value="core_and_shell" @selected($project->finish_type == 'core_and_shell')>
                                                                        {{ __('Core And Shell') }}
                                                                    </option>
                                                                    <option value="half_finished"
                                                                        @selected($project->finish_type == 'half_finished')>
                                                                        {{ __('Half Finished') }}
                                                                    </option>
                                                                    <option value="fully_finished" @selected($project->finish_type == 'fully_finished')>
                                                                        {{ __('Fully Finished') }}
                                                                    </option>
                                                                </select>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 mt-3">
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheck3" name="status"
                                                                    @checked(old('status', $project->status == 1))>
                                                                <label class="form-check-label"
                                                                    for="customCheck3">{{ __('Status') }}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="FinanceCheck" name="finance" {{ $project->finance == 1 ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="FinanceCheck">{{ __('هل يصلح للتمويل العقاري ') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mt-2 accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="property-accordion-header">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#property-accordion-content" aria-expanded="false"
                                                    aria-controls="property-accordion-content">
                                                    {{ __('Facilities') }}
                                                </button>
                                            </h2>
                                            <div id="property-accordion-content"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <div class="mb-3">
                                                        {{-- <label for="propertyType" class="form-label">{{
                                                            __('Facilities') }}</label> --}}
                                                        <div>
                                                            <div class="row">
                                                                @foreach ($propertys as $item)
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="{{ $item->id }}"
                                                                            id="property-{{ $item->id }}"
                                                                            name="properties[]" {{ $project->property->contains('id', $item->id) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="property-{{ $item->id }}">
                                                                            {{ $item->trans()->where('locale', $current_lang)->first()->title }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
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
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ __('Cover') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-0 align-items-center col-md-12">
                                                <div class="mb-1 row align-items-center col-md-6">
                                                    <div class="m-1 col-md-3">
                                                        <img src="{{ asset($project->cover) }}" width="200"
                                                            class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            {{ __('Images') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-0 align-items-center col-md-12">
                                                @foreach ($project->attachments as $item)
                                                <div class="mb-1 row align-items-center col-md-6">
                                                    <div class="m-1 col-md-3" style="position: relative; width: 60%">
                                                        <!-- Delete Icon -->
                                                        <a href="{{ route('admin.buildings.delete_sigle.image', $item->id) }}"
                                                            class="btn btn-sm remove-image"
                                                            style="color: red; position: absolute; top: 0; right: 0;">
                                                            <i class="ri-delete-bin-fill"></i>
                                                        </a>
                                                        <!-- Image -->
                                                        <img src="{{ asset($item->image) }}" width="200"
                                                            class="img-fluid rounded-start" alt="...">
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
                <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
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
    $('.select2-multiple').select2({
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
<script>
    // Get the category select element
    var categorySelect = document.getElementById('select2-multiple');
    // Get the input fields to hide/show
    var toggleContent = document.getElementById('toggle-content');
    document.addEventListener("DOMContentLoaded", function() {
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
</script>
@endsection