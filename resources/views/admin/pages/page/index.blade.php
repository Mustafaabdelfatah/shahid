@extends('admin.dashboard')
@section('title', __('Pages Setting'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('All Pages') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                </div>
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title Section') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Images') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($homeSettings as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->title_section }}</td>
                                    <td>{{ $item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ $item->image }}" alt="image"
                                                class="img-fluid avatar-sm rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            @if ($item->status == 1)
                                                <a href="{{ route('admin.page.update-status', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm" title="{{ __('Active') }}"><i
                                                        class="ri-shield-check-fill"></i></a>
                                            @else
                                                <a href="{{ route('admin.page.update-status', $item->id) }}"
                                                    class="btn btn-outline-warning btn-sm" title="{{ __('Inactive') }}"><i
                                                        class="ri-shield-check-line"></i></a>
                                            @endif
                                            <a href="{{ route('admin.page.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i></a>

                                        </div>
                                    </td>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
