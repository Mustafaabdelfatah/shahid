@extends('admin.dashboard')
@section('title', __('Packages'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('All Packages') }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    @include('layouts.admin.message')
                    <a href="{{ route('admin.packages.create') }}"
                        class="btn btn-primary float-end mt-4 btn-sm">{{ __('Create Package') }}</a>
                </div> --}}
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Package Type') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($packages as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            <a href="{{ route('admin.packages.show', $item->id) }}"
                                                class="btn btn-pink btn-sm" title="{{ __('Show') }}"><i
                                                    class="ri-eye-fill"></i></a>
                                            @if ($item->type != 'normal')
                                                <a href="{{ route('admin.packages.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                        class="ri-edit-line"></i></a>
                                            @elseif ($item->type == 'normal')
                                                <a href=""></a>
                                            @endif
                                            {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button> --}}
                                        </div>
                                        @include('admin.pages.package._model_delete')
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
