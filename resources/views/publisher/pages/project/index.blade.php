@extends('publisher.dashboard')
@section('title', __('project'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('All projects') }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                    <a href="{{ route('publisher.projects.create') }}"
                        class="btn btn-primary float-end mt-4 btn-sm">{{ __('Create project') }}</a>
                </div>
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('address') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            {{-- @if ($item->status == 1)
                                                <a href="{{ route('publisher.projects.update-status', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm" title="{{ __('Active') }}"><i
                                                        class="ri-star-fill "></i></a>
                                            @else
                                                <a href="{{ route('publisher.projects.update-status', $item->id) }}"
                                                    class="btn btn-outline-warning btn-sm" title="{{ __('Inactive') }}"><i
                                                        class="ri-star-s-line "></i></a>
                                            @endif --}}
                                            <a href="{{ route('publisher.projects.show', $item->id) }}"
                                                class="btn btn-pink btn-sm" title="{{ __('Show') }}"><i
                                                    class="ri-eye-fill"></i></a>
                                            <a href="{{ route('publisher.projects.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                        @include('publisher.pages.project._model_delete')
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
