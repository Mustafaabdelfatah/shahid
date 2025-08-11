@extends('admin.dashboard')
@section('title', __('News'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('Create News') }}</h4>
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
                        <a href="{{ route('admin.news.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
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
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            @foreach ($languages as $index => $locale)
                                                {{-- title --}}
                                                <div class="row mb-3">
                                                    <label class="form-label" for="title{{ $index }}">
                                                        {{ __('Title in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="{{ $locale }}[title]"
                                                        value="{{ old($locale . '.title') }}" id="title{{ $index }}">
                                                    @if ($errors->has($locale . '.title'))
                                                        <span
                                                            class="text-danger">{{ $errors->first($locale . '.title') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="form-label" for="sub_title{{ $index }}">
                                                        {{ __('Sub Title') . Illuminate\Support\Facades\Lang::get($locale) }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="{{ $locale }}[sub_title]"
                                                        value="{{ old($locale . '.sub_title') }}" id="sub_title{{ $index }}">
                                                    @if ($errors->has($locale . '.sub_title'))
                                                        <span
                                                            class="text-danger">{{ $errors->first($locale . '.sub_title') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="form-label" for="description{{ $index }}">
                                                        {{ __('Description in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-sm-12 mb-2">
                                                        <textarea id="description{{ $index }}"
                                                            name="{{ $locale }}[description]"
                                                            class="form-control">{{ old($locale . '.description') }}</textarea>
                                                        @if ($errors->has($locale . '.description'))
                                                            <span
                                                                class="text-danger">{{ $errors->first($locale . '.description') }}</span>
                                                        @endif
                                                        <script type="text/javascript">
                                                            CKEDITOR.replace('description{{ $index }}', {
                                                                filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                                                                filebrowserUploadMethod: 'form'
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion mt-2" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingAds">
                                        <button class="accordion-button fw-medium collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseAds"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseAds">
                                            {{ __('Meta') }}
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseAds" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingAds">
                                        <div class="accordion-body">
                                            @foreach ($languages as $index => $locale)
                                                <div class="row mb-3">
                                                    <label class="form-label" for="meta_title{{ $index }}">
                                                        {{ __('Meta Title') . ' ' . Illuminate\Support\Facades\Lang::get($locale) }}
                                                    </label>
                                                    <input class="form-control" type="text" name="{{ $locale }}[meta_title]"
                                                        value="{{ old($locale . '.meta_title') }}"
                                                        id="meta_title{{ $index }}">
                                                    @if ($errors->has($locale . '.meta_title'))
                                                        <span
                                                            class="text-danger">{{ $errors->first($locale . '.meta_title') }}</span>
                                                    @endif
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="form-label" for="meta_description{{ $index }}">
                                                        {{ __('Meta Description') . ' ' . Illuminate\Support\Facades\Lang::get($locale) }}
                                                    </label>
                                                    <textarea name="{{ $locale }}[meta_description]" class="form-control"
                                                        id="meta_description{{ $index }}">{{ old($locale . '.meta_description') }}</textarea>
                                                    @if ($errors->has($locale . '.meta_description'))
                                                        <span
                                                            class="text-danger">{{ $errors->first($locale . '.meta_description') }}</span>
                                                    @endif
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="form-label" for="meta_key{{ $index }}">
                                                        {{ __('Meta Keywords') . ' ' . Illuminate\Support\Facades\Lang::get($locale) }}
                                                    </label>
                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control"
                                                        id="meta_key{{ $index }}">{{ old($locale . '.meta_key') }}</textarea>
                                                    @if ($errors->has($locale . '.meta_key'))
                                                        <span
                                                            class="text-danger">{{ $errors->first($locale . '.meta_key') }}</span>
                                                    @endif
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
                                        aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image">
                                                        {{ __('Image') }}<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" class="form-control" id="image" name="image[]"
                                                        multiple>

                                                    @error('image.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <!-- Container to display image previews -->
                                                    <div id="image-preview-container" class="mt-3 d-flex flex-wrap">
                                                        @if(isset($news->images))
                                                            @foreach($news->images as $item)
                                                                <div class="position-relative me-2 mb-2">
                                                                    <img src="{{ asset($item->image) }}"
                                                                        class="img-fluid rounded shadow" alt="Image Preview"
                                                                        style="width: 150px; height: 100px; object-fit: cover;">
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="sort">{{ __('Sort') }}</label>
                                                <input type="number" class="form-control" id="sort" name="sort"
                                                    value="{{ old('sort') }}">
                                                @error('sort')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="select2Multiple"
                                                    class="form-label">{{ __('Choose Categories ...') }}</label>
                                                <select class="select2 form-control select2-multiple_catgeory"
                                                    data-toggle="select2" id="select2Multiple" multiple="multiple"
                                                    data-placeholder="{{__('Choose Categories ...')}}"
                                                    name="category[]">
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mt-3">
                                                <label for="select2Multple"
                                                    class="form-label">{{ __('Choose Tags ...') }}</label>
                                                <select class="select2 form-control select2-multiple"
                                                    data-toggle="select2" id="select2Multple" multiple="multiple"
                                                    data-placeholder="{{__('Choose Tags ...')}}" name="tags[]">
                                                    @foreach ($tags as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-check mt-3 form-check-inline">
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

    $('.select2-multiple_catgeory').select2({
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // Clear any existing previews

        const files = event.target.files;

        if (files) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.width = 100;
                    imgElement.classList.add('img-thumbnail', 'mb-2');
                    previewContainer.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            });
        }
    });

</script>
@endsection