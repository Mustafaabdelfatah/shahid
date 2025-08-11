@extends('admin.dashboard')
@section('title', __('category job'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('admin.category_job.index') }}">{{__('category Job')}}</a>
                    </li>
                    <li class="breadcrumb-item active text-info">{{ __('Edit category Job') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('category Job') }}</h4>
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
                        <a href="{{route('admin.category_job.index')}}" class="btn btn-primary float-end">{{ __('Back')
                            }}</a>
                    </div>
                </div>
            </div>
            <form action="{{route('admin.category_job.update', $category_job->id)}}" method="POST"
                enctype="multipart/form-data">
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
                                                                                                value="{{ old($locale . '.title', optional($category_job->trans()->where('locale', $locale)->first())->title) }}"
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