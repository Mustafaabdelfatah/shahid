@extends('publisher.dashboard')
@section('title', __('project'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('Create project') }}</h4>
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
                        <a href="{{ route('publisher.projects.index') }}" class="btn btn-primary float-end">{{
                            __('Back') }}</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('publisher.projects.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <div class="mb-3">
                                                    <label class="form-label" for="title{{ $index }}">{{ __('Description
                                                        in ') . Illuminate\Support\Facades\Lang::get($locale) }}</label>
                                                    <textarea name="{{ $locale }}[description]"
                                                        id="description{{ $index }}">{{ old($locale . '.description') }}</textarea>
                                                    @if ($errors->has($locale . '.description'))
                                                    <span class="text-danger">{{ $errors->first($locale .
                                                        '.description') }}</span>
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
                        <div class="col-lg-6">
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
                                                        <label class="form-label" for="image">{{ __('Image') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" id="image" name="image">
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="address">{{ __('Address') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="address"
                                                            name="address" value="{{ old('address') }}">
                                                        @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @livewire('select-country-product')

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
    document.addEventListener("DOMContentLoaded", function() {
        // Get the category select element
        var categorySelect = document.getElementById('select2-multiple');
        // Get the input fields to hide/show
        var toggleContent = document.getElementById('toggle-content');
        // Add event listener to category select
        categorySelect.addEventListener('change', function() {
            // Check if the selected category is "land" (assuming its value is "land")
            if (categorySelect.value == 3 ) {
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