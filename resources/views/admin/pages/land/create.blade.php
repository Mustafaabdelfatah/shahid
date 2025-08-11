@extends('admin.dashboard')
@section('title', __('Lands'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.lands.index') }}">{{ __('Lands') }}</a>
                        </li>
                        </li>
                        <li class="breadcrumb-item active text-info">{{ __('Create Lands') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('Lands') }}</h4>
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
                            <a href="{{ route('admin.lands.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.lands.store') }}" method="POST" enctype="multipart/form-data">
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
                                                    {{-- title ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="title{{ $index }}">{{ __('Title in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control" type="text"
                                                                name="{{ $locale }}[title]"
                                                                value="{{ old($locale . '.title') }}"
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
                                                            @if ($errors->has($locale . '.description'))
                                                            <span
                                                                class="missiong-spam text-danger">{{ $errors->first($locale . '.description') }}</span>
                                                        @endif
                                                            <textarea id="description{{ $index }}" name="{{ $locale }}[description]"> {{ old($locale . '.description') }} </textarea>

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
                                                {{ __('Setting lands') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="image">{{ __('image') }}</label>
                                                        <input type="file" id="image" class="form-control"
                                                            name="image">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="price">{{ __('Price') }}</label>
                                                    <input type="text" class="form-control" id="price" name="price"
                                                        value="{{ old('price') }}">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="address">{{ __('address') }}</label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="{{ old('address') }}">
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>



                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3"
                                                        name="status">
                                                    <label class="form-check-label"
                                                        for="customCheck3">{{ __('Status') }}</label>
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
