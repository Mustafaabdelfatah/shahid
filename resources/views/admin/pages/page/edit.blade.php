@extends('admin.dashboard')
@section('title', __('Pages Setting'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class=" page-title">{{ __('Edit Page') }}</h4>
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
                            <a href="{{ route('admin.page.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.page.update', $homeSetting->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                                                value="{{ old($locale . '.title', optional($homeSetting->trans()->where('locale', $locale)->first())->title) }}"
                                                                id="title{{ $index }}">
                                                            @if ($errors->has($locale . '.title'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="title{{ $index }}">{{ __('Description in ') . Illuminate\Support\Facades\Lang::get($locale) }}</label>
                                                            <textarea name="{{ $locale }}[description]" id="description{{ $index }}">{{ old($locale . '.description', optional($homeSetting->trans()->where('locale', $locale)->first())->description) }}</textarea>
                                                            @if ($errors->has($locale . '.description'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first($locale . '.description') }}</span>
                                                            @endif
                                                        </div>
                                                        <script type="text/javascript">
                                                            ClassicEditor
                                                                .create(document.querySelector('#description{{ $index }}'))
                                                                .catch(error => {
                                                                    console.error(error);
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
                                                {{ __('Setting portfolios') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="title_section">{{ __('Title Section') }}</label>
                                                    <input type="title" class="form-control" id="title_section"
                                                        name="title_section" value="{{ $homeSetting->title_section }}"
                                                        disabled value="{{ old('title_section') }}">
                                                    @error('title_section')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="image_cover">{{ __('Image Cover') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" id="image_cover"
                                                        name="image" value="{{ old('image') }}">
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($homeSetting->image)
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('Current Image') }}</label>
                                                        <img src="{{ $homeSetting->image }}"
                                                            alt="{{ $homeSetting->image }}" class="img-fluid">
                                                    </div>
                                                @endif
                                                <div class="mb-3">
                                                    <label class="form-label" for="url_video">{{ __('Video Url') }}</label>
                                                    <input type="url" class="form-control" id="url_video"
                                                        name="url_video" value="{{ old('url_video') }}">
                                                    @error('url_video')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($homeSetting->url_video)
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('Current Video') }}</label>
                                                        <iframe src="{{ $homeSetting->url_video }}" width="640"
                                                            height="384" frameborder="0"
                                                            allow="autoplay;  picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                @endif
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3" @checked($homeSetting->status == 1)
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

@endsection
