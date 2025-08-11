@extends('admin.dashboard')
@section('title', __('Units'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Edit Unit') }}</h4>
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

                            <a href="{{ route('admin.units.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                            @if ($unit->paying == 'Installment')
                                <a href="{{ route('admin.unit-installments.create', $unit->id) }}"
                                    class="btn btn-info mx-1 float-end">
                                    <i class="ri-pages-fill"></i> {{ __('Add Installment') }}
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
                <form action="{{ route('admin.units.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <!-- currentPage -->
                                    <input type="hidden" name="page" value="{{ $currentPage }}">
                                        <!-- currentPage -->
                                         
                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                                        aria-controls="panelsStayOpen-collapseOne">
                                                        {{ __('Title') }}
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingOne" style>
                                                    <div class="accordion-body">
                                                        @foreach ($languages as $index => $locale)
                                                            <div class="mb-3 row">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="title{{ $index }}">{{ __('Title in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[title]"
                                                                        value="{{ old($locale . '.title', optional($unit->trans()->where('locale', $locale)->first())->title) }}"
                                                                        id="title{{ $index }}">
                                                                    @if ($errors->has($locale . '.title'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="description{{ $index }}">
                                                                        {{ __('Description in ') . Illuminate\Support\Facades\Lang::get($locale) }}
                                                                    </label>
                                                                    <textarea name="{{ $locale }}[description]" id="description{{ $index }}" class="form-control" required
                                                                        maxlength="5000" oninput="updateCharCount(this, {{ $index }})" cols="3" rows="10">{{ old($locale . '.description', optional($unit->trans()->where('locale', $locale)->first())->description) }}</textarea>
                                                                    <div class="d-flex justify-content-between">
                                                                        <small class="text-muted">Max length: 5000</small>
                                                                        <small class="text-muted"><span
                                                                                id="charCount{{ $index }}">0</span>/5000</small>
                                                                    </div>
                                                                    @if ($errors->has($locale . '.description'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first($locale . '.description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="mb-2">
                                                        <div class="mb-3">
                                                            <label for="notes" class="form-label">اي ملاحظات اضافية</label>
                                                            <textarea name="notes" id="notes" class="form-control" rows="5">
                                                            {{ old('notes', $unit->notes) }}
                                                            </textarea>
                                                        </div>
                                                    </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 col-lg-12">
                                        <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#attachment"
                                                        aria-expanded="false" aria-controls="attachment">
                                                        {{ __('Attachments') }}
                                                    </button>
                                                </h2>
                                                <div id="attachment" class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingTwo" style>
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="plan">{{ __('Cover Photo') }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="file" class="form-control"
                                                                        id="plan" name="plan"
                                                                        value="{{ old('plan') }}">
                                                                    @error('plan')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    @if ($unit->plan)
                                                                        <div
                                                                            class="m-2 row g-0 align-items-center col-md-12">
                                                                            <img src="{{ asset($unit->plan) }}"
                                                                                width="10%"
                                                                                class="img-fluid rounded-start"
                                                                                alt="plan image">
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <!-- upload-images.blade.php -->

                                                            <div class="col-sm-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="image">{{ __('Image') }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="file" class="form-control"
                                                                        id="image" name="image[]" multiple>
                                                                    @error('image.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="row g-0 align-items-center col-md-12">
                                                                    @foreach ($unit->images as $item)
                                                                        <div class="mb-1 row align-items-center col-md-6">
                                                                            <div class="m-1 col-md-3"
                                                                                style="position: relative; width: 60%">
                                                                                <!-- Delete Icon -->
                                                                                <a href="{{ route('admin.units.delete_sigle.image', $item->id) }}"
                                                                                    class="btn btn-sm remove-image"
                                                                                    style="color: red; position: absolute; top: 0; right: 0;">
                                                                                    <i class="ri-delete-bin-fill"></i>
                                                                                </a>
                                                                                <!-- Image -->
                                                                                <img src="{{ asset($item->image) }}"
                                                                                    width="200"
                                                                                    class="img-fluid rounded-start"
                                                                                    alt="...">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @if ($unit->video_unit)
                                                                <div class="col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="video">{{ __('Video') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="file" class="form-control"
                                                                            id="video" name="video_unit"
                                                                            value="{{ old('video') }}">
                                                                        @error('video_unit')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="row g-0 align-items-center col-md-12">

                                                                        <video width="320" height="240" controls>
                                                                            <source src="{{ asset($unit->video_unit) }}"
                                                                                type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
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
                                                {{ __('Properties') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="type">{{ __('Unit Type') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control" id="type" name="type">
                                                                <option value="rent" @selected($unit->type == 'rent')>
                                                                    {{ __('Rent') }}</option>
                                                                <option value="sale" @selected($unit->type == 'sale')>
                                                                    {{ __('Sale') }}</option>
                                                            </select>
                                                            @error('type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="user_id">{{ __('Select Owner') }}</label>
                                                            <select name="user_id" class="form-control select2" id="userDropdown">
                                                                <option value="">{{ __('Select Owner') }}</option>
                                                                @foreach($owners as $item)
                                                                    <option value="{{ $item->id }}" @selected(isset($unit) && $unit->user_id == $item->id)>
                                                                        {{ $item->name }}
                                                                    </option>                                                                    
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="user_id">{{__('Select Admins')}}</label>
                                                            <select name="admin_id" id="admin_id" class="form-control">
                                                                <option value="">{{__('Select Admins')}}</option>
                                                                @foreach($admins as $item)
                                                                    <option value="{{ $item->id }}" @selected(isset($unit) && $unit->admin_id == $item->id)>
                                                                        {{ $item->name }}
                                                                    </option>                                                               
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="main_category">{{ __('Main Category') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" id="main_category"
                                                                name="main_category">
                                                                <option value="Residential">{{ __('Select Category') }}
                                                                </option>
                                                                <option value="Administrative"
                                                                    @selected($unit->main_category == 'Administrative')>{{ __('Administrative') }}
                                                                </option>
                                                                <option value="Residential" @selected($unit->main_category == 'Residential')>
                                                                    {{ __('Residential') }}</option>
                                                                <option value="Commercial" @selected($unit->main_category == 'Commercial')>
                                                                    {{ __('Commercial') }}</option>
                                                            </select>
                                                            @error('main_category')
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
                                                                <option value="Installment" @selected($unit->paying == 'installment')>
                                                                    {{ __('installment') }}</option>
                                                                <option value="cash" @selected($unit->paying == 'cash')>
                                                                    {{ __('cash') }}</option>
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
                                                            <select class=" form-control" id="Furnished"
                                                                name="Furnished">
                                                                <option>{{ __('Select Method') }}</option>
                                                                <option value="Furnished" @selected($unit->Furnished == 'Furnished')>
                                                                    {{ __('Furnished') }}
                                                                </option>
                                                                <option value="Unfurnished" @selected($unit->Furnished == 'Unfurnished')>
                                                                    {{ __('Unfurnished') }}</option>
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
                                                            <select class=" form-control" id="Finishing_type"
                                                                name="Finishing_type">
                                                                <option>{{ __('Select Method') }}</option>
                                                                <option value="red_bricks" @selected($unit->Finishing_type == 'red_bricks')>
                                                                    {{ __('Red Bricks') }}</option>
                                                                <option value="finishing_text"
                                                                    @selected($unit->Finishing_type == 'finishing_text')>
                                                                    {{ __('Finishing text') }}</option>
                                                                <option value="super_deluxe" @selected($unit->Finishing_type == 'super_deluxe')>
                                                                    {{ __('Super deluxe') }}</option>
                                                                <option value="lux" @selected($unit->Finishing_type == 'lux')>
                                                                    {{ __('Personal finishing') }}</option>
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
                                                            <select class=" form-control select2-multiple"
                                                                id="select2-multiple" name="category_id">
                                                                <option value="" disabled selected>
                                                                    {{ __('Choose Catgerory') }} ...</option>
                                                                @foreach ($categories as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @selected($unit->category_id == $item->id)>
                                                                        {{ @$item->trans()->where('locale', $current_lang)->first()->title }}
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
                                                                for="Furnished">{{ __('Furnished') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control" id="Furnished" name="Furnished">
                                                                <option>{{ __('Select Method') }}</option>
                                                                @foreach ($Furnished as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @selected($unit->category_id == $item->id)>
                                                                        {{ @$item->trans()->where('locale', $current_lang)->first()->title }}
                                                                    </option>
                                                                @endforeach
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
                                                            <select class=" form-control" id="Finishing_type" name="Red_Bricks">
                                                                <option>{{ __('Select Method') }}</option>
                                                                <option value="Red Bricks">{{ __('Red Bricks') }}
                                                                </option>
                                                                <option value="Finishing text">{{ __('Finishing text') }}</option>
                                                                <option value="Super deluxe">{{ __('Super deluxe') }}</option>
                                                                <option value="Lux">{{ __('Lux') }}</option>
                                                            </select>
                                                            @error('Finishing_type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="select2-multiple">{{ __('Projects') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control">
                                                                <option selected disabled>{{ __('Choose Project') }}
                                                                </option>
                                                                @foreach ($projects as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @selected($unit->project_id == $item->id)>
                                                                        {{ @$item->trans()->where('locale', $current_lang)->first()->title }}
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
                                                                name="price" value="{{ old('price', $unit->price) }}">
                                                            @error('price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-sm-3 ">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="service_charges">{{ __('Service Charges') }}</label>
                                                            <input type="number" class="form-control"
                                                                id="service_charges" name="service_charges"
                                                                value="{{ old('service_charges', $unit->service_charges) }}">
                                                            @error('service_charges')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-sm-3 ">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="size">{{ __('Space') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="size"
                                                                name="size" value="{{ old('size', $unit->size) }}">
                                                            @error('size')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="rooms">{{ __('Rooms') }}</label>
                                                            <input type="number" class="form-control" id="rooms"
                                                                name="rooms" value="{{ old('rooms', $unit->rooms) }}">
                                                            @error('rooms')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="bathroom">{{ __('Bathroom') }}</label>
                                                            <input type="number" class="form-control" id="bathroom"
                                                                name="bathroom"
                                                                value="{{ old('bathroom', $unit->bathroom) }}">
                                                            @error('bathroom')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="floor">{{ __('Floor') }}</label>
                                                            <input type="number" class="form-control" id="floor"
                                                                name="floor" value="{{ old('floor', $unit->floor) }}">
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
                                                                name="code" value="{{ old('code', $unit->code) }}">
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
                                                                name="location"
                                                                value="{{ old('location', $unit->location) }}">
                                                            @error('location')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="building_number">{{ __('Building Number') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="building_number"
                                                                    name="building_number"  value="{{ old('location', $unit->building_number) }}">
                                                                @error('building_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    <div class="col-md-6">
                                                        <label for="select2Multiple"
                                                            class="form-label">{{ __('District') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control w-100" id="select2Multiple"
                                                            name="district_id">
                                                            <option>{{ __('Choose District') }}</option>

                                                            @foreach ($districts as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $unit->district_id ? 'selected' : '' }}>
                                                                    {{ @$item->trans->where('locale', $current_lang)->first()->title }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('district_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-3 col-sm-12">
                                                        
                                                        <div class="mt-3 col-sm-12">
                                                            <select name="delivery_date" id="delivery_date"
                                                                class="form-control">
                                                                <option value="">{{__('Delivery Year')}}</option>
                                                                @for ($year = now()->year; $year <= now()->year + 15; $year++)
                                                                    <option value="{{ $year }}"
                                                                        {{ old('delivery_date', $unit->delivery_date ?? '') == $year ? 'selected' : '' }}>
                                                                        {{ $year }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="select2-multiple">{{ __('Gates') }}<span
                                                                    class="text-danger">*</span></label>

                                                            <select class=" form-control" id="select2-multiple"
                                                                name="gates_id"
                                                                data-placeholder="{{ __('Choose Gates') }} ...">
                                                                <option>{{ __('Select Gates') }}</option>
                                                                @foreach ($gates as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $unit->gates_id ? 'selected' : '' }}>
                                                                        {{ @$item->trans->where('locale', $current_lang)->first()->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('gates_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    {{-- @livewire('update-select-country-product', ['product' => $unit]) --}}
                                                    <div class="col-sm-12">
                                                        <div class="mt-2 accordion" id="accordionPanelsStayOpenExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="gates-accordion-header">
                                                                    <button class="accordion-button fw-medium collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#gates-accordion-content"
                                                                        aria-expanded="false"
                                                                        aria-controls="gates-accordion-content">
                                                                        {{ __('Gates') }}
                                                                    </button>
                                                                </h2>
                                                                <div id="gates-accordion-content"
                                                                    class="accordion-collapse collapse show">
                                                                    <div class="accordion-body">
                                                                        <div class="mb-3">
                                                                            <div>
                                                                                <div class="row">
                                                                                    @foreach ($gates as $gate)
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-check">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    value="{{ $gate->id }}"
                                                                                                    id="gate-{{ $gate->id }}"
                                                                                                    name="gates[]"
                                                                                                    {{ $unit->gates->contains('id', $gate->id) ? 'checked' : '' }}>
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="gate-{{ $gate->id }}">
                                                                                                    {{ $gate->trans()->where('locale', $current_lang)->first()->title }}
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
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
                                                                    class="accordion-collapse collapse show">
                                                                    <div class="accordion-body">
                                                                        <div class="mb-3">
                                                                            {{-- <label for="propertyType" class="form-label">{{ __('Facilities') }}</label> --}}
                                                                            <div>
                                                                                <div class="row">
                                                                                    @foreach ($propertys as $item)
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-check">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    value="{{ $item->id }}"
                                                                                                    id="property-{{ $item->id }}"
                                                                                                    name="properties[]"
                                                                                                    {{ $unit->property->contains('id', $item->id) ? 'checked' : '' }}>
                                                                                                <label
                                                                                                    class="form-check-label"
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
                                                                    <span
                                                                        class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                                @enderror
                                                                @error('properties.*')
                                                                    <span
                                                                        class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 col-sm-12">
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck3" name="status"
                                                                {{ $unit->status == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="customCheck3">{{ __('Status') }}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="FinanceCheck" name="finance"
                                                                {{ $unit->finance == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="FinanceCheck">{{ __('Finance') }}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="FawryCheck" name="fawry"
                                                                {{ $unit->fawry == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="FawryCheck">{{ __('Fawry') }}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck2" name="primum"
                                                                {{ $unit->primum == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="customCheck2">{{ __('Primum') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-wrap gap-2 p-2 mt-1 d-flex float-end">
                            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                        </div>
                    </div>
                </form>

                <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('.select2').select2({
                    placeholder: "{{ __('Select Owner') }}",
                    allowClear: true
                });
            });
        </script>
@endsection
