@extends('admin.dashboard')
@section('title', __('Edit Job'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">{{ __('Jobs') }}</a></li>
                    <li class="breadcrumb-item active text-info">{{ __('Edit Job') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('Edit Job') }}</h4>
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
                        <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- تستخدم لتحديد نوع الطلب كـ PUT -->
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button fw-medium collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                            {{ __('Edit Job') }}
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show justify-content-center"
                                        aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">

                                            <div class="mb-3">
                                                <label class="form-label" for="title">{{ __('job_title') }}</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ old('title', $job->title) }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="sub_title">{{ __('job_sub_title') }}</label>
                                                <input type="text" class="form-control" id="sub_title" name="sub_title"
                                                    value="{{ old('sub_title', $job->sub_title) }}">
                                                @error('sub_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">{{ __('job_desc') }}</label>
                                                <textarea name="description" id="description" class="form-control"
                                                    rows="5">{{ old('description', $job->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="address">{{ __('job_address') }}</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address', $job->address) }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>

        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#description'), {
                height: 'auto', // اجعل المحرر يتوسع تلقائيًا
                minHeight: '120px', // يمكن تحديد ارتفاع مبدئي، إذا لزم الأمر
            })
            .catch(error => {
                console.error('There was a problem initializing CKEditor:', error);
            });
    });
</script>
@endsection
