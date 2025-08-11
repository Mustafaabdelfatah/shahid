@extends('admin.dashboard')
@section('title',__('Category'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{__('All Category')}}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.categories_news.create') }}" class="btn btn-primary float-end">{{ __('Create Category') }}</a>

            </div>
            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.categories_news.actions') }}" method="post">
                    @csrf
                </form>
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <tr class="bluck-actions" style="display: none" scope="row">
                                <td colspan="8">
                                    <div class="col-md-12 mt-0 mb-0 text-center">

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
                            <th>{{ __('Sort') }}</th>
                            <th>{{ __('Actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categoryNews as $item)
                            <tr>
                                <td>
                                    <input form="update-pages" class="checkbox-check" type="checkbox"
                                        name="record[{{ $item->id }}]" value={{ $item->id }}>
                                </td>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $item->trans->where('locale',$current_lang)->first()->title }}</td>
                                <td>{{ $item->sort }}</td>
                                <td>
                                    <div class=" d-flex  justify-content-around">
                                        <a href="{{ route('admin.categories_news.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                class="ri-edit-line"></i></a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#danger-header-modal{{ $item->id }}"
                                            title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                    @include('admin.pages.categoryNews._model_delete')
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>

            </div> <!-- end card body-->
            <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $categoryNews->links('layouts.admin.pagination') }}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
