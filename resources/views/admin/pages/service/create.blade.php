@extends('admin.dashboard')
@section('title', __('Services'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('Create Service') }}</h4>
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
                        <a href="{{ route('admin.services.index') }}" class="btn btn-primary float-end">{{ __('Back')
                            }}</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
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
                                                        value="{{ old($locale . '.title') }}" id="title{{ $index }}">
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
                                                    <textarea id="description{{ $index }}" name="{{ $locale }}[description]"> {{ old($locale . '.description') }} </textarea>
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
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label" for="sort">{{ __('Sort') }}</label>
                                                    <input type="number" class="form-control" id="sort" name="sort"
                                                        value="{{ old('sort') }}">
                                                    @error('sort')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="select2-multiple">{{ __('Category Service') }}<span class="text-danger">*</span></label>
                                                        {{-- //onchange={(e)=>value = e.target.value} --}}
                                                        <select class=" form-control" id="select2-multiple"
                                                            name="category_service_id"
                                                            data-placeholder="{{ __('Choose Catgerory') }} ...">
                                                            <option>{{ __('Select Catgerory') }}</option>
                                                            @foreach ($category_service as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ @$item->trans->where('locale',
                                                                $current_lang)->first()->title }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_service_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="image">{{ __('Images') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image[]" multiple>
                                                        @error('image.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                                        <input type="number" class="form-control" id="phone"
                                                            name="phone" value="{{ old('phone') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="facebook" class="form-label">{{ __('Facebook')
                                                            }}</label>
                                                        <input type="text" class="form-control" id="facebook"
                                                            name="facebook" value="{{ old('facebook') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="twitter" class="form-label">{{ __('Twitter')
                                                            }}</label>
                                                        <input type="text" class="form-control" id="twitter"
                                                            name="twitter" value="{{ old('twitter') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="instagram" class="form-label">{{ __('Instagram')
                                                            }}</label>
                                                        <input type="text" class="form-control" id="instagram"
                                                            name="instagram" value="{{ old('instagram') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="map" class="form-label">{{ __('Map') }}</label>
                                                        <input type="text" class="form-control" id="pinterest"
                                                            name="map" value="{{ old('map') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">{{ __('Address')
                                                            }}</label>
                                                        <textarea name="address" id="address"
                                                            class="form-control">{{ old('address') }}</textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-sm-12">
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
                                                            <div id="property-accordion-content"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="property-accordion-header">
                                                                <div class="accordion-body">
                                                                    <div class="mb-3">

                                                                        <div class="row">
                                                                            @foreach ($features as $item)
                                                                            <div class="col-md-6">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        value="{{ $item->id }}"
                                                                                        id="features-{{ $item->id }}"
                                                                                        name="features[]">
                                                                                    <label class="form-check-label"
                                                                                        for="features-{{ $item->id }}">
                                                                                        {{ $item->trans->where('locale',
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
                                                            @error('features')
                                                            <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                            @enderror
                                                            @error('features.*')
                                                            <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div> --}}
                                                <div class="form-check mt-3 form-check-inline">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3"
                                                        name="status">
                                                    <label class="form-check-label" for="customCheck3">{{ __('Status')
                                                        }}</label>
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

@endsection
