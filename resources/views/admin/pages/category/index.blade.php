@extends('admin.dashboard')
@section('title', __('Categories'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('All Categories') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.categories.create') }}"
                    class="btn btn-primary float-end">{{ __('Create Categories') }}
                </a>
            </div>
            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.categories.actions') }}" method="post">
                    @csrf
                </form>
                <table  class=" dt-responsive nowrap w-100 table table-bordered">
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
                        <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                            <tr>
                                <td>
                                    <input form="update-pages" class="checkbox-check" type="checkbox"
                                        name="record[{{ $item->id }}]" value={{ $item->id }}>
                                </td>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if ($item->status == 1)
                                                <li>
                                                    <a href="{{ route('admin.categories.update-status', $item->id) }}"
                                                        class="btn text-success  dropdown-item text-center fa-bold"
                                                        title="{{ __('Active') }}">
                                                        {{ __('Active') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('admin.categories.update-status', $item->id) }}"
                                                        class="btn text-warning dropdown-item text-center fa-bold"
                                                        title="{{ __('Inactive') }}">
                                                        {{ __('Inactive') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('admin.categories.edit',['id' => $item->id, 'page' => request('page')]) }}"
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
                                        @include('admin.pages.category._model_delete')
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>

            </div> <!-- end card body-->
            <div class="card-footer">
                <!-- Display pagination links -->
                {{ $categories->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
