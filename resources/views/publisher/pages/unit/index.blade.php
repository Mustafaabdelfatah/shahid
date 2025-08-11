@extends('publisher.dashboard')
@section('title', __('Units'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('All Units') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                    <a href="{{ route('publisher.units.create') }}" class="btn btn-primary float-end  m-1  btn-sm"><i
                            class="ri-add-box-fill"></i></a>
                    @if ($isManager)
                        <a href="{{ route('publisher.units.all_unit_teams') }}"
                            class="btn btn-success float-end m-1  btn-sm"><i
                                class="ri-community-line"></i>{{ __('Unit Team') }}</a>
                    @endif
                    <button type="button" class="btn btn-info btn-sm " data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <i class="ri-filter-fill"></i>
                    </button>
                    <a href="{{ route('publisher.units.index') }}" class="btn btn-primary btn-sm"><i
                            class="ri-restart-line"></i></a>

                    @include('publisher.pages.unit._model_search')
                </div>
                <div class="card-body">
                    <form id="update-pages" action="{{ route('publisher.units.actions') }}" method="post">
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
                            <th>{{ __('Image') }}</th>
                            {{-- <th>{{ __('Categories') }}</th> --}}
                            <th>{{ __('Type') }}</th>
                            {{-- <th>{{ __('paying') }}</th> --}}
                            <th>{{ __('Unit Code') }}</th>
                            {{-- <th>{{ __('Created By') }}</th> --}}
                            <th>{{ __('Publication Status') }}</th>
                            <th>{{ __('For sale') }}</th>
                            <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $item)
                                <tr>
                                    <td>
                                        <input form="update-pages" class="checkbox-check" type="checkbox"
                                            name="record[{{ $item->id }}]" value={{ $item->id }}>
                                    </td>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}</th>
                                    <td><img src="{{ asset($item->plan) }}" class="rounded" width="70" alt="">
                                    </td>
                                    {{-- <td>{{ $item->trans->where('locale', $current_lang)->first()->title }}</td> --}}
                                    {{-- <td>{{ $item->category->trans->where('locale', $current_lang)->first()->title }}</td> --}}
                                    <td>{{ $item->type }}</td>
                                    {{-- <td>{{ $item->paying }}</td> --}}
                                    <td>{{ $item->code }}</td>
                                    {{-- <td>{{ @$item->create_by->name }}</td> --}}
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-outline-success">{{ __('Published') }}</span>
                                        @else
                                            <span class=" badge badge-outline-danger">{{ __('Unpublished') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->for_sale == 1)
                                            <span class="badge badge-outline-success">{{ __('Sold') }}</span>
                                        @else
                                            <span class=" badge badge-outline-warning">{{ __('For sale') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class=" d-flex  justify-content-around">
                                            @if (Auth::user()->role == 'broker' || Auth::user()->role == 'agency')
                                                @if ($item->approve == 1)
                                                    <a href="{{ route('publisher.units.update_approve', $item->id) }}"
                                                        class="btn btn-outline-success btn-sm"
                                                        title="{{ __('Active') }}"><i class="ri-star-fill"></i></a>
                                                @else
                                                    <a href="{{ route('publisher.units.update_approve', $item->id) }}"
                                                        class="btn btn-outline-warning btn-sm"
                                                        title="{{ __('Inactive') }}"><i class="ri-star-s-line"></i></a>
                                                @endif
                                            @endif

                                            @if ($item->for_sale == 1)
                                                <a href="{{ route('publisher.units.for_sale', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm" title="{{ __('Sold') }}"><i
                                                        class="ri-shield-check-fill"></i>
                                                @else
                                                    <a href="{{ route('publisher.units.for_sale', $item->id) }}"
                                                        class="btn btn-outline-warning btn-sm"
                                                        title="{{ __('For Sale') }}"><i
                                                            class="ri-shield-check-line"></i></a>
                                            @endif

                                            <a href="{{ route('publisher.units.show', $item->id) }}"
                                                class="btn btn-pink btn-sm" title="{{ __('Show') }}"><i
                                                    class="ri-eye-fill"></i></a>
                                            <a href="{{ route('publisher.units.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                    class="ri-edit-line"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger-header-modal{{ $item->id }}"
                                                title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                        @include('publisher.pages.unit._model_delete')
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                </div> <!-- end card body-->
                {{-- <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $products->links('layouts.admin.pagination') }}
            </div> --}}
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
