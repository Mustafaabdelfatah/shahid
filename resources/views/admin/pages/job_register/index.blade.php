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
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>{{ __('job') }}</th>
                                <th>{{ __('First name') }}</th>
                                <th>{{ __('Last name') }}</th>
                                <th>{{ __('Contact number') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Notice_period') }}</th>
                                <th>{{ __('Work link') }}</th>
                                <th>{{ __('Resume') }}</th>
                                <th>{{ __('Current_salary') }}</th>
                                <th>{{ __('Expected_salary') }}</th>
                                {{-- <th>{{ __('Actions') }}</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($jobs as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    </td>
                                    <td>{{ $item->job->title }}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->contact_number }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->notice_period }}</td>
                                    <td>{{ $item->work_link }}</td>
                                    <td>
                                        @if ($item->resume == null)
                                            لايوجدCv
                                        @else
                                        <a href="{{ $item->resume }}" target="_blank">View Resume</a>
                                        @endif
                                    </td>
                                    <td>{{ $item->current_salary }}</td>
                                    <td>{{ $item->expected_salary }}</td>

                                    <td>
                                        <div class=" d-flex  justify-content-around">

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                        @include('admin.pages.job_register._model_delete')
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
