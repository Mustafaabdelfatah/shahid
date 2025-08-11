@extends('admin.dashboard')
@section('title', __('Services'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{__('Edit Services')}}</h4>
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
                        <a href="{{route('admin.services.index')}}" class="btn btn-primary float-end">{{ __('Back')
                            }}</a>
                    </div>
                </div>
            </div>
            <form action="{{route('admin.services.update', $service->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- currentPage -->
                        <input type="hidden" name="page" value="{{ $currentPage }}">
                        <!-- currentPage -->

                        <div class="col-lg-7">
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
                                                                                            <label class="form-label" for="title{{ $index }}">{{ __('Title in ')
                                                . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                                                                    class="text-danger">*</span></label>
                                                                                            <input class="form-control" type="text" name="{{ $locale }}[title]"
                                                                                                value="{{ old($locale . '.title', optional($service->trans()->where('locale', $locale)->first())->title) }}"
                                                                                                id="title{{ $index }}">
                                                                                            @if ($errors->has($locale . '.title'))
                                                                                                <span class="text-danger">{{ $errors->first($locale . '.title')
                                                                                                    }}</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mb-3">
                                                                                        <label class="form-label" for="title{{ $index }}">{{ __('description in ')
                                                . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div class="col-sm-12 mb-2">
                                                                                            <textarea id="description{{ $index }}"
                                                                                                name="{{ $locale }}[description]">  {{ old($locale . '.title', optional($service->trans()->where('locale', $locale)->first())->description) }} </textarea>
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
                        <div class="col-lg-5">
                            <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button fw-medium collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                            {{ __('Setting Services') }}
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingTwo" style>
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <label class="form-label" for="sort">{{ __('Sort') }}</label>
                                                <input type="number" class="form-control" id="sort" name="sort"
                                                    value="{{ old('sort', $service->sort) }}">
                                                @error('sort')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="select2-multiple">{{ __('Category
                                                        Service') }}<span class="text-danger">*</span></label>
                                                    {{-- //onchange={(e)=>value = e.target.value} --}}
                                                    <select class=" form-control" id="select2-multiple"
                                                        name="category_service_id"
                                                        data-placeholder="{{ __('Choose Catgerory') }} ...">
                                                        <option>{{ __('Select Catgerory') }}</option>
                                                        @foreach ($category_service as $item)
                                                                                                                <option value="{{ $item->id }}" @selected(
                                                                $item->id ==
                                                                $service->category_service_id
                                                            )>
                                                                                                                    {{ @$item->trans->where(
                                                                'locale',
                                                                $current_lang
                                                            )->first()->title }}
                                                                                                                </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_service_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image">{{ __('Image') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" id="image" name="image[]"
                                                        multiple>
                                                    @error('image.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row g-0 align-items-center col-md-12">
                                                    @foreach ($service->images as $item)
                                                        <div class="mb-1 row align-items-center col-md-6">
                                                            <div class="m-1 col-md-3"
                                                                style="position: relative; width: 60%">
                                                                <!-- Delete Icon -->
                                                                <a href="{{ route('admin.services.delete_sigle.image', $item->id) }}"
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
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">{{__('Email
                                                        Website')}}</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{old('email', $service->email)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">{{__('Phone
                                                        Website')}}</label>
                                                    <input type="number" class="form-control" id="phone" name="phone"
                                                        value="{{old('phone', $service->phone)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="facebook" class="form-label">{{__('Facebook')}}</label>
                                                    <input type="text" class="form-control" id="facebook"
                                                        name="facebook" value="{{old('facebook', $service->facebook)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="twitter" class="form-label">{{__('Twitter')}}</label>
                                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                                        value="{{old('twitter', $service->twitter)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="instagram"
                                                        class="form-label">{{__('Instagram')}}</label>
                                                    <input type="text" class="form-control" id="instagram"
                                                        name="instagram"
                                                        value="{{old('instagram', $service->instagram)}}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="map" class="form-label">{{__('Map')}}</label>
                                                    <input type="text" class="form-control" id="pinterest" name="map"
                                                        value="{{old('map', $service->map)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">{{__('Address
                                                        Website')}}</label>
                                                    <textarea name="address" id="address"
                                                        class="form-control">{{old('address', $service->address)}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-check mt-3 form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="customCheck3"
                                                    name="status" @checked($service->status == 1)>
                                                <label class="form-check-label" for="customCheck3">{{ __('Status')
                                                    }}</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-2 accordion" id="accordionPanelsStayOpenExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="property-accordion-header">
                                                            <button class="accordion-button fw-medium collapsed"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#property-accordion-content"
                                                                aria-expanded="false"
                                                                aria-controls="property-accordion-content">
                                                                {{ __('Features') }}
                                                            </button>
                                                        </h2>
                                                        {{-- <div id="property-accordion-content"
                                                            class="accordion-collapse collapse show">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label for="propertyType" class="form-label">{{
                                                                        __('Facilities') }}</label>
                                                                    <div>
                                                                        <div class="row">
                                                                            @foreach ($features as $item)
                                                                            <div class="col-md-6">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        value="{{ $item->id }}"
                                                                                        id="property-{{ $item->id }}"
                                                                                        name="features[]" {{
                                                                                        $service->features->contains('id',
                                                                                    $item->id) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="features-{{ $item->id }}">
                                                                                        {{
                                                                                        $item->trans()->where('locale',
                                                                                        $current_lang)->first()->title
                                                                                        }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        @error('features')
                                                            <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @error('features.*')
                                                            <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                        <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>

                    </div>
                </div>
            </form>

            <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection