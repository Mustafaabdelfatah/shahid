@extends('admin.dashboard')
@section('title',__('category service'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{__('Edit category service')}}</h4>
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
                        <a href="{{route('admin.category_service.index')}}" class="btn btn-primary float-end">{{ __('Back')
                            }}</a>
                    </div>
                </div>
            </div>
            <form action="{{route('admin.category_service.update', $category_service->id)}}" method="POST" enctype="multipart/form-data">
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
                                            {{-- title
                                            -------------------------------------------------------------------------------------
                                            --}}
                                            <div class="row mb-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title{{ $index }}">{{ __('Title in ')
                                                        . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="{{ $locale }}[title]"
                                                        value="{{ old($locale . '.title', optional($category_service->trans()->where('locale', $locale)->first())->title) }}"
                                                        id="title{{ $index }}">
                                                    @if ($errors->has($locale . '.title'))
                                                    <span class="text-danger">{{ $errors->first($locale . '.title')
                                                        }}</span>
                                                    @endif
                                                </div>
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
                                            {{ __('Setting category service') }}
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingTwo" style>
                                        <div class="accordion-body">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image">{{ __('Image') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        multiple>
                                                    @error('image.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row g-0 align-items-center col-md-12">
                                                    <div class="mb-1 row align-items-center col-md-6">
                                                            <!-- Image -->
                                                            <img src="{{ asset($category_service->image) }}" class="rounded" width="500"
                                                                class="img-fluid rounded-start" alt="...">
                                                        </div>
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