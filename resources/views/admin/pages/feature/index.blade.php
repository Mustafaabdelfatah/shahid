@extends('admin.dashboard')
@section('title', __('Features'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('All Features') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.features.create') }}" class="btn btn-primary float-end">{{ __('Create Feature') }}</a>

            </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($features as $item)
                        <tr>

                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>

                            <td>
                                <div class=" d-flex  justify-content-around">

                                    <a href="{{ route('admin.features.edit', $item->id) }}"
                                        class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                            class="ri-edit-line"></i></a>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#danger-header-modal{{ $item->id }}"
                                        title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                </div>
                                @include('admin.pages.feature._model_delete')
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