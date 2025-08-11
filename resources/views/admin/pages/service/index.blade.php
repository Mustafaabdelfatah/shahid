@extends('admin.dashboard')
@section('title', __('Services'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ __('All Services') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary float-end">{{ __('Create
                    Services') }}</a>

            </div>
            <div class="card-body">

                <table class=" dt-responsive nowrap w-100 table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <!-- <th>{{ __('Sort') }}</th> -->
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>
                                    @if ($item->images->isNotEmpty())
                                        <img src="{{ asset($item->images->first()->image) }}" width="150"
                                            class="img-fluid rounded-start" alt="...">
                                    @else
                                        <img src="{{ asset('default-image.png') }}" width="50" class="img-fluid rounded-start"
                                            alt="...">
                                    @endif
                                </td>                                <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                                <td>{{ @$item->create_by?->email }}</td>
                                <td>{{ @$item->category_service->trans->where('locale', $current_lang)->first()->title }}
                                </td>
                                <td>{{ $item->phone }}</td>
                                <!-- <td>{{ $item->sort }}</td> -->
                                <td>{{ $item->create_by?->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if ($item->status == 1)
                                                <li>
                                                    <a href="{{ route('admin.services.update-status', $item->id) }}"
                                                        class="btn text-success  dropdown-item text-center fa-bold"
                                                        title="{{ __('Active') }}">
                                                        {{ __('Active') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('admin.services.update-status', $item->id) }}"
                                                        class="btn text-warning dropdown-item text-center fa-bold"
                                                        title="{{ __('Inactive') }}">
                                                        {{ __('Inactive') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('admin.services.edit', [$item->id, 'id' => $item->id, 'page' => request('page')]) }}"
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
                                        @include('admin.pages.service._model_delete')
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
                {{ $services->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection