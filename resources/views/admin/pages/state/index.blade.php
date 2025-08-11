@extends('admin.dashboard')
@section('title', __('States'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{ __('All States') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.states.create') }}" class="btn btn-primary float-end">{{ __('Create Country')
                    }}</a>

            </div>
            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.states.actions') }}" method="post">
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
                        <th>{{ __('Country') }}</th>
                        <th>{{ __('Sort') }}</th>
                        <th>{{ __('Created By') }}</th>
                        <th>{{__('States')}}</th>
                        <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($states as $item)
                        <tr>
                            <td>
                                <input form="update-pages" class="checkbox-check" type="checkbox"
                                    name="record[{{ $item->id }}]" value={{ $item->id }}>
                            </td>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                            <td>{{ @$item->country->trans->where('locale', $current_lang)->first()->title }}</td>
                            <td>{{ $item->sort }}</td>
                            <td>{{ @$item->create_by->name }}</td>
                            <td>
                                @if ($item->status == 1)
                                <span class="badge badge-outline-success">{{ __('Active') }}</span>
                                @else
                                <span class=" badge badge-outline-danger">{{ __('Unactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class=" d-flex  justify-content-around">
                                    <a href="{{ route('admin.states.edit', $item->id) }}" class="btn btn-primary btn-sm"
                                        title="{{ __('Edit') }}"><i class="ri-edit-line"></i></a>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#danger-header-modal{{ $item->id }}"
                                        title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                </div>
                                @include('admin.pages.state._model_delete')
                            </td>
                        </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div> <!-- end card body-->
            <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $states->links('layouts.admin.pagination')}}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection