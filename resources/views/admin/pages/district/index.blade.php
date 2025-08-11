@extends('admin.dashboard')
@section('title', __('Districts'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('All Districts') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                    <a href="{{ route('admin.districts.create') }}"
                        class="btn btn-primary float-end">{{ __('Create District') }}</a>

                </div>
                <div class="card-body">
                    <form id="update-pages" action="{{ route('admin.districts.actions') }}" method="post">
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
                            <th>{{ __('Name') }}</th>
                            {{-- <th>{{ __('Country') }}</th>
                            <th>{{ __('States') }}</th>
                            <th>{{ __('City') }}</th> --}}
                            <th>{{ __('Sort') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Status') }}</th>
                            {{-- <th>{{ __('Updated By') }}</th> --}}
                            <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($districts as $item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    </td>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ @$item->trans->where('locale', $current_lang)->first()->title }}</td>
                                    {{-- 
                                    <td>{{ @$item->country->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>{{ @$item->state->trans->where('locale', $current_lang)->first()->title }}</td>
                                    <td>{{ @$item->city->trans->where('locale', $current_lang)->first()->title }}</td> --}}
                                    <td>{{ $item->sort }}</td>
                                    <td>{{ @$item->create_by->name }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-outline-success">{{ __('Active') }}</span>
                                        @else
                                            <span class=" badge badge-outline-danger">{{ __('Unactive') }}</span>
                                        @endif
                                    </td>
                                    {{-- <td>{{@$item->update_by->name}}</td> --}}
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Settings') }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a href="{{ route('admin.districts.edit', $item->id) }}"
                                                        class="btn text-primary dropdown-item text-center fa-bold" title="{{ __('Edit') }}">
                                                        {{ __('Edit') }}
                                                    </a>
                                                </li>

                                                <button type="button" class="btn text-danger dropdown-item text-center fa-bold"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#danger-header-modal{{ $item->id }}"
                                                    title="{{ __('Delete') }}">
                                                    {{ __('Delete') }}
                                                </button>
                                            </ul>
                                            @include('admin.pages.district._model_delete')
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div> <!-- end card body-->
 -->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
