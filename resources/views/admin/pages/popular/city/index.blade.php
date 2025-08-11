@extends('admin.dashboard')
@section('title', __('Popular'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('All Popular City And Unit') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                    <a href="{{ route('admin.popular_cities.create') }}"
                        class="btn btn-primary float-end btn-sm">{{ __('Create') }}</a>
                </div>
                <div class="card-body">
                    <form id="update-pages" action="{{ route('admin.popular_cities.actions') }}" method="post">
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
                                <th>{{ __('City Name') }}</th>
                                <th>{{ __('Unit Name') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($popularCity as $item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    </td>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->city->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>
                                        @foreach ($item->popular_city_unit as $item_unit)
                                            @if ($item_unit->unit && $item_unit->unit->trans)
                                                <span>
                                                    {{ $item_unit->unit->trans->where('locale', $current_lang)->first()->title ?? '' }}
                                                </span>
                                                <br>
                                            @else
                                                N/A
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ @$item->create_by->name }}</td>
                                    <td>
                                        <div class=" d-flex justify-content-around">
                                            @if ($item->status == 1)
                                                <a href="{{ route('admin.popular_cities.update-status', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm" title="{{ __('Active') }}"><i
                                                        class="ri-star-fill "></i></a>
                                            @else
                                                <a href="{{ route('admin.popular_cities.update-status', $item->id) }}"
                                                    class="btn btn-outline-warning btn-sm" title="{{ __('Inactive') }}"><i
                                                        class="ri-star-s-line "></i></a>
                                            @endif

                                            <a href="{{ route('admin.popular_cities.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                        @include('admin.pages.popular.city._model_delete')
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                </div> <!-- end card body-->
                <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                    {{ $popularCity->links('layouts.admin.pagination') }}
                </div>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
