@extends('publisher.dashboard')
@section('title', __('Units'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('All Team Units') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    @include('layouts.admin.message')
                    <a href="{{ route('publisher.units.index') }}"
                        class="btn btn-primary mt-4 float-end">{{ __('Back') }}</a>

                    <form action="{{ route('publisher.units.index') }}" method="get">
                        <div class="row mt-3">
                            <div class="col-md-4 mt-1">
                                <input type="text" value="{{ request()->title != '' ? request()->title : '' }}"
                                    name="title" placeholder="{{ trans('Search by title') }}" class="form-control">
                            </div>
                            <div class="col-md-4 mt-1">
                                <select class="select form-control select2 " name="type">
                                    <option selected value="">{{ __('Project Type') }}</option>
                                    <option value="rent">{{ __('Rent') }}</option>
                                    <option value="sale">{{ __('Sale') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <select class="select form-control select2 " name="category_id">
                                    <option selected value="">{{ __('Categories') }}</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">
                                            {{ @$item->trans()->where('locale', $current_lang)->first()->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <select class="select form-control" name="approve">
                                    <option selected value="">{{ __('Approve') }} </option>
                                    <option value="1"
                                        {{ old('approve', request()->input('approve')) == 1 ? 'selected' : '' }}>
                                        @lang('approve') </option>
                                    <option value="0"
                                        {{ old('approve', request()->input('approve')) != 1 && old('approve', request()->input('approve')) != null
                                            ? 'selected'
                                            : '' }}>
                                        @lang('No Active') </option>
                                </select>
                            </div>
                            <div class="search-input col-md-6  mt-1">
                                <button class="btn btn-primary btn-sm" type="submit" title="{{ __('Search') }}"><i
                                        class="ri-search-eye-line"></i> {{ __('Search') }}</button>
                                <a class="btn btn-success btn-sm" href="{{ route('publisher.units.index') }}"
                                    title="{{ __('reset') }}"><i class="ri-restart-line"></i> {{ __('Reset') }}</a>
                                <a class="btn btn-purple btn-sm" href="{{ route('publisher.units.all_unit_teams') }}"><i
                                        class="ri-product-hunt-line"></i> {{ __('All Units Teams') }}</a>
                             
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Categories') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Size') }}</th>
                                <th>{{ __('Sort') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $item)
                                <tr>
                                    <th scope="row">

                                        {{ $loop->index + 1 }}</th>
                                    <td>{{ $item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>{{ $item->category->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->sort }}</td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            @if (Auth::user()->role == 'broker' || Auth::user()->role == 'agency')
                                                @if ($item->approve == 1)
                                                    <a href="{{ route('publisher.units.update_approve', $item->id) }}"
                                                        class="btn btn-outline-success btn-sm"
                                                        title="{{ __('Active') }}"><i
                                                            class="ri-check-double-line"></i></a>
                                                @else
                                                    <a href="{{ route('publisher.units.update_approve', $item->id) }}"
                                                        class="btn btn-outline-warning btn-sm"
                                                        title="{{ __('Inactive') }}"><i class="ri-check-line"></i></a>
                                                @endif
                                            @endif

                                            <a href="{{ route('publisher.units.show', $item->id) }}"
                                                class="btn btn-pink btn-sm" title="{{ __('Show') }}"><i
                                                    class="ri-eye-fill"></i></a>
                                            <a href="{{ route('publisher.units.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                        @include('publisher.pages.unit._model_delete')
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
