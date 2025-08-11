@extends('admin.dashboard')
@section('title', __('jobs'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">{{ __('jobs') }}</a></li>
                    <li class="breadcrumb-item active text-info">{{ __('All jobs') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('jobs') }}</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary float-end">{{ __('Create jobs') }}</a>
            </div>
            <div class="card-body">
                <table class=" dt-responsive nowrap w-100 table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 1px">
                                <input form="update-pages" class="checkbox-check flat cursor-pointer" type="checkbox"
                                    name="check-all" id="check-all" title="check-all">
                            </th>
                            <th>#</th>
                            <th>{{ __('job_title') }}</th>
                            <th>{{ __('job_sub_title') }}</th>
                            <th>{{ __('job_desc') }}</th>
                            <th>{{ __('job_address') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($jobs as $item)
                            <tr>
                                <td>
                                    <input form="update-pages" class="checkbox-check" type="checkbox"
                                        name="record[{{ $item->id }}]" value="{{ $item->id }}">
                                </td>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->sub_title }}</td>
                                <td>{{ Str::limit($item->description, 20) }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    <div class=" d-flex  justify-content-around">
                                        <a href="{{ route('admin.jobs.edit', $item->id) }}" class="btn btn-primary btn-sm"
                                            title="{{ __('Edit') }}">
                                            <i class="ri-edit-line"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#danger-header-modal{{ $item->id }}"
                                            title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                    @include('admin.pages.jobs._model_delete')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">{{ __('No jobs available.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end card body -->

        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
