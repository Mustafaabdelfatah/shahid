@extends('admin.dashboard')
@section('title', __('Admins'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class=" page-title">{{ __('Admins') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary float-end">{{ __('Add Admin') }}</a>
            </div>
            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.admins.actions') }}" method="post">
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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{__('units Count')}}</th>
                        <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                            <tr>


                                <td>
                                    @if ($item->id != 1)
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    @endif
                                </td>

                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.admins.units', $item->id) }}">
                                        {{ $item->products_count ?? 0 }} اضغط لرؤية الوحدات
                                    </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if ($item->status == 1)
                                                <li>
                                                    <a href="{{ route('admin.admins.update-status', $item->id) }}"
                                                        class="btn text-success  dropdown-item text-center fa-bold"
                                                        title="{{ __('Active') }}">
                                                        {{ __('Active') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('admin.admins.update-status', $item->id) }}"
                                                        class="btn text-warning dropdown-item text-center fa-bold"
                                                        title="{{ __('Inactive') }}">
                                                        {{ __('Inactive') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('admin.admins.edit', $item->id) }}"
                                                    class="btn text-primary dropdown-item text-center fa-bold"
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
                                        @include('admin.pages.admins._model_delete')
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div> <!-- end card body-->
            <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $users->links('layouts.admin.pagination') }}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection