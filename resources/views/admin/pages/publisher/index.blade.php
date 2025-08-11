@extends('admin.dashboard')
@section('title', __('Users'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class=" page-title">{{ __('Users') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form id="update-pages" action="{{ route('admin.users.actions') }}" method="post">
                        @csrf
                    </form>
                    @include('layouts.admin.message')
                    <a href="{{ route('admin.users.create') }}"
                        class="btn btn-primary float-end mt-4 btn-sm">{{ __('Add User') }}</a>
                    <form action="{{ route('admin.users.index') }}" method="get">
                        <div class="row mt-3">
                            <div class="col-md-3 mt-1">
                                <input type="text" value="{{ request()->building_number != '' ? request()->building_number : '' }}"
                                    name="building_number" placeholder="{{ trans('Search by Building Number') }}" class="form-control">
                            </div>
                            <div class="col-md-3 mt-1">
                                <input type="text" value="{{ request()->name != '' ? request()->name : '' }}"
                                    name="name" placeholder="{{ trans('Search by name') }}" class="form-control">
                            </div>
                            <div class="col-md-3 mt-1">
                                <input type="text" value="{{ request()->email != '' ? request()->email : '' }}"
                                    name="email" placeholder="{{ trans('Search by email') }}" class="form-control">
                            </div>
                            <div class="col-md-3 mt-1">
                                <input type="text" value="{{ request()->phone != '' ? request()->phone : '' }}"
                                    name="phone" placeholder="{{ trans('Search by mobile') }}" class="form-control">
                            </div>
                            <div class="col-md-3 mt-1">
                                <select class="select form-control select2 " name="role">
                                    <option selected value="">{{ __('Select Roles') }}</option>
                                    <option value="unit_onwer">{{ __('Unit Onwer') }}</option>
                                    <option value="broker">{{ __('Broker') }}</option>
                                    <option value="client">{{ __('Client') }}</option>
                                    <option value="agency">{{ __('Agency') }}</option>
                                    <option value="employee">{{ __('Employee') }}</option>
                                </select>
                            </div>

                            <div class="col-md-3 mt-1">
                                <select class="select form-control" name="status">
                                    <option selected value=""> @lang('Status') </option>
                                    <option value="1"
                                        {{ old('status', request()->input('status')) == 1 ? 'selected' : '' }}>
                                        @lang('Active') </option>
                                    <option value="0"
                                        {{ old('status', request()->input('status')) != 1 && old('status', request()->input('status')) != null
                                            ? 'selected'
                                            : '' }}>
                                        @lang('No Active') </option>

                                </select>
                            </div>
                            <div class="search-input col-md-2  mt-1">
                                <button class="btn btn-primary btn-sm" type="submit" title="{{ __('Search') }}"><i
                                        class="ri-search-eye-line"></i></button>
                                <a class="btn btn-success btn-sm" href="{{ route('admin.users.index') }}"
                                    title="{{ __('reset') }}"><i class="ri-restart-line"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
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
                            <!-- <th>{{ __('Email') }}</th> -->
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{__('units Count')}}</th>
                            <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    </td>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <!-- <td>{{ $item->email }}</td> -->
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.units', $item->id) }}">
                                            {{ $item->products_count ?? 0 }} اضغط لرؤية الوحدات
                                        </a>
                                    </td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            @if ($item->status == 1)
                                                <a href="{{ route('admin.users.update-status', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm" title="{{ __('Active') }}"><i
                                                        class="ri-star-fill "></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.users.update-status', $item->id) }}"
                                                    class="btn btn-outline-warning btn-sm"
                                                    title="{{ __('Inactive') }}"><i class="ri-star-s-line "></i>
                                                </a>
                                            @endif
                                                <a href="{{ route('admin.users.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i>
                                                </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                        @include('admin.pages.publisher._model_delete')
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                </div> <!-- end card body-->
                {{-- <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                    {{ $users->links('layouts.admin.pagination') }}
                </div> --}}
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
