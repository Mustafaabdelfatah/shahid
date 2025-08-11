@extends('admin.dashboard')
@section('title', __('contact'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{ __('All Recent Massages') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.admin.message')
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
                        <th>{{ __('email') }}</th>
                        <th>{{ __('phone') }}</th>
                        <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    @if ($contact->count() > 0)

                        <tbody>
                            @forelse ($contact as $item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    </td>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ @$item->name }}</td>
                                    <td>{{ @$item->email }}</td>
                                    <td>{{ @$item->phone }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Settings') }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a href="{{ route('admin.contacts.show', $item->id) }}"
                                                        class="btn text-primary dropdown-item text-center fa-bold"
                                                        title="{{ __('show') }}">
                                                        {{ __('show') }}
                                                    </a>
                                                </li>

                                                <button type="button" class="btn text-danger dropdown-item text-center fa-bold"
                                                    data-bs-toggle="modal" data-bs-target="#danger-header-modal{{ $item->id }}"
                                                    title="{{ __('Delete') }}">
                                                    {{ __('Delete') }}
                                                </button>
                                            </ul>
                                            @include('admin.pages.contact._model_delete')
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    @else
                        <h1 class="text-center text-danger">No Messages</h1>
                    @endif
                </table>

            </div> <!-- end card body-->
            {{-- <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $contact->links('layouts.admin.pagination')}}
            </div> --}}
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection