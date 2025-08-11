@extends('admin.dashboard')
@section('title', __('View Job'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">{{ __('Jobs') }}</a></li>
                    <li class="breadcrumb-item active text-info">{{ __('View Job') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('View Job') }}</h4>
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
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="font-weight-bold">{{ __('job_title') }}:</h5>
                    <p class="lead">{{ $job->title }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="font-weight-bold">{{ __('job_sub_title') }}:</h5>
                    <p class="lead">{{ $job->sub_title }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="font-weight-bold">{{ __('job_desc') }}:</h5>
                    <div class="border p-3 rounded">
                        {!! $job->description !!}
                    </div>
                </div>
                <div class="mb-3">
                    <h5 class="font-weight-bold">{{ __('job_address') }}:</h5>
                    <p>{{ $job->address }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST"
                        onsubmit="return confirm('{{ __('Are you sure you want to delete this job?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection