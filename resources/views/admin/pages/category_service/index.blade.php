@extends('admin.dashboard')
@section('title', __('Category Service'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('All Category Service') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.category_service.create') }}" class="btn btn-primary float-end">{{ __('Create Category Service') }}</a>

            </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($category_service as $item)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><img src="{{ asset($item->image) }}" class="rounded" width="70" alt=""></td>
                            <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                            <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Settings') }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a href="{{ route('admin.category_service.edit', $item->id) }}"
                                                        class="btn text-primary dropdown-item text-center fa-bold" title="{{ __('Edit') }}">
                                                        {{ __('Edit') }}
                                                    </a>
                                                </li>

                                                <button type="button" class="btn text-danger dropdown-item text-center fa-bold"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#danger-header-modal{{ $item->id }}"
                                                    title="{{ __('Delete') }}">
                                                    {{ __('Delete') }}
                                                </button>
                                            </ul>
                                            @include('admin.pages.category_service._model_delete')
                                        </div>
                                    </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

            </div> <!-- end card body-->

        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection