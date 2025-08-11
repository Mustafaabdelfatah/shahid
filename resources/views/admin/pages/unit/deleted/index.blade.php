@extends('admin.dashboard')

@section('title', __('All Deleted Units'))

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.units.index') }}">{{ __('Units') }}</a>
                        </li>
                        <li class="breadcrumb-item active text-info">{{ __('All deleted Units') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('All deleted Units') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('layouts.admin.message')
                <div class="card-body">
                    <a href="{{ route('admin.units.index') }}" class="btn btn-primary float-end btn-sm">{{__('Back')}}</a>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('image') }}</th>
                                <th>{{ __('Unit Code') }}</th>
                                <th>{{ __('Primum') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Settings') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td><img src="{{ asset($item->caver_image) }}" class="rounded" width="70"
                                            alt=""></td>
                                    <td>
                                        {{ $item->code }}</td>
                                    <td>
                                        @if ($item->primum == 1)
                                            <span class="badge badge-outline-warning">{{ __('Primum') }}</span>
                                        @else
                                            <span class=" badge badge-outline-danger">{{ __('Not Primum') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ @$item->create_by->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Settings') }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>

                                                    <button type="button" class="dropdown-item  text-center"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#success-alert-modal{{ $item->id }}">
                                                        {{ __('Recovery') }}</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item  text-center" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#danger-header-modal{{ $item->id }}">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        @include('admin.pages.unit.deleted._model_recovery', [
                                            'id' => $item->id,
                                        ])
                                        @include('admin.pages.unit.deleted._model_delete', [
                                            'id' => $item->id,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">{{ __('No unit found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
