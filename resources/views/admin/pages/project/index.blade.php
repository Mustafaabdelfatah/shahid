@extends('admin.dashboard')
@section('title', __('Buildings'))
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.buildings.index') }}">{{ __('Buildings') }}</a>
                        </li>
                        <li class="breadcrumb-item active text-info">{{ __('All Buildings') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('Buildings') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('layouts.admin.message')
                <div class="card-header">
                    <a href="{{ route('admin.buildings.create') }}" class="btn btn-primary float-end"><i
                            class="ri-file-add-line"></i></a>

                    <button type="button" class="btn btn-info  " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="ri-equalizer-line"></i>
                    </button>
                    <a href="{{ route('admin.buildings.index') }}" class="btn btn-primary"><i
                            class="ri-refresh-line"></i></a>
                </div>
                @include('admin.pages.project._model_search')
                <div class="card-body">
                    <form id="update-pages" action="{{ route('admin.buildings.actions') }}" method="post">
                        @csrf
                    </form>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                            <tr class="bluck-actions" style="display: none" scope="row">
                                <td colspan="8">
                                    <div class="col-md-12 mt-0 mb-0 text-center">
                                        <button form="update-pages" class="btn btn-success btn-sm" type="submit"
                                            name="publish" value="1"> <i class="ri-star-fill "></i></button>
                                        <button form="update-pages" class="btn btn-warning btn-sm" type="submit"
                                            name="unpublish" value="1"><i class="ri-star-s-line "></i></button>
                                        <button form="update-pages" class="btn btn-danger btn-sm" type="submit"
                                            name="delete_all" value="1"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <th style="width: 1px">
                                <input form="update-pages" class="checkbox-check flat cursor-pointer" type="checkbox"
                                    name="check-all" id="check-all" title="check-all">
                            </th>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Cover Image') }}</th>
                            <th>{{ __('Developer name') }}</th>
                            <th>{{ __('Delivery Date') }}</th>
                            <th>{{ __('Method Payment') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($buildings as $item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    </td>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td><img src="{{ asset($item->cover) }}" class="rounded" width="70" alt="">
                                    </td>
                                    <td>{{ @$item->user->name }}</td>
                                    <td>{{ $item->delivery_date }}</td>
                                    <td>{{ $item->method_payment }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ @$item->user->name }}</td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            @if ($item->status == 1)
                                                <a href="{{ route('admin.buildings.update-status', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm" title="{{ __('Active') }}"><i
                                                        class="ri-star-fill "></i></a>
                                            @else
                                                <a href="{{ route('admin.buildings.update-status', $item->id) }}"
                                                    class="btn btn-outline-warning btn-sm" title="{{ __('Inactive') }}"><i
                                                        class="ri-star-s-line "></i></a>
                                            @endif
                                            <a href="{{ route('admin.buildings.show', $item->id) }}"
                                                class="btn btn-pink btn-sm" title="{{ __('Show') }}"><i
                                                    class="ri-eye-fill"></i></a>
                                                    <a href="{{ route('admin.buildings.edit', [$item->id, 'id' => $item->id, 'page' => request('page')]) }}"
                                                    class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                        @include('admin.pages.project._model_delete')
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div> <!-- end card body-->
                <div class="card-footer">
                <!-- Display pagination links -->
                {{ $buildings->links('vendor.pagination.bootstrap-4') }}
            </div>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
