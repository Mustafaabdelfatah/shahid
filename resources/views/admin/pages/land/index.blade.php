@extends('admin.dashboard')
@section('title', __('Lands'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.lands.index') }}">{{ __('Lands') }}</a></li>
                    <li class="breadcrumb-item active text-info">{{ __('All Lands') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('Lands') }}</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.lands.create') }}"
                    class="btn btn-primary float-end">{{ __('Create Lands') }}</a>
            </div>

            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.lands.actions') }}" method="post">
                    @csrf
                </form>

                <table class=" dt-responsive nowrap w-100 table table-bordered">
                    <thead>
                        <tr class="bluck-actions" style="display: none">
                            <td colspan="8">
                                <div class="col-md-12 mt-0 mb-0 text-center">
                                    <button form="update-pages" class="btn btn-success btn-sm" type="submit"
                                        name="publish" value="1"><i class="ri-star-fill"></i></button>
                                    <button form="update-pages" class="btn btn-warning btn-sm" type="submit"
                                        name="unpublish" value="1"><i class="ri-star-s-line"></i></button>
                                    <button form="update-pages" class="btn btn-danger btn-sm" type="submit"
                                        name="delete_all" value="1"><i class="ri-delete-bin-line"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 1px">
                                <input form="update-pages" class="checkbox-check flat cursor-pointer" type="checkbox"
                                    name="check-all" id="check-all" title="check-all">
                            </th>
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($lands as $item)
                            <tr>
                                <td>
                                    <input form="update-pages" class="checkbox-check" type="checkbox"
                                        name="record[{{ $item->id }}]" value="{{ $item->id }}">
                                </td>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td><img src="{{ asset($item->image) }}" class="rounded" width="70" alt="image">
                                <td>{{ $item->trans->where('locale', $current_lang)->first()->title ?? 'No Title' }}
                                </td>
                                <td>{{ $item->address }}</td>
                                <td>{{ number_format($item->price, 0, '', ',') }}</td>
                                <td>{{ $item->create_by->name ?? 'Unknown' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if ($item->status == 1)
                                                <li>
                                                    <a href="{{ route('admin.lands.update-status', $item->id) }}"
                                                        class="btn text-success  dropdown-item text-center fa-bold"
                                                        title="{{ __('Active') }}">
                                                        {{ __('Active') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('admin.lands.update-status', $item->id) }}"
                                                        class="btn text-warning dropdown-item text-center fa-bold"
                                                        title="{{ __('Inactive') }}">
                                                        {{ __('Inactive') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('admin.lands.edit', [$item->id, 'id' => $item->id, 'page' => request('page')]) }}"
                                                    ) }}" class="btn text-primary dropdown-item text-center fa-bold"
                                                    title="{{ __('Edit') }}">
                                                    {{ __('Edit') }}
                                                </a>
                                            </li>

                                            <button type="button" class="btn text-danger dropdown-item text-center fa-bold"
                                                data-bs-toggle="modal" data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}">
                                                {{ __('Delete') }}
                                            </button>
                                        </ul>
                                        @include('admin.pages.land._model_delete')
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">{{ __('No lands available.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end card body -->

            <div class="card-footer">
                <!-- Display pagination links -->
                {{ $lands->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection