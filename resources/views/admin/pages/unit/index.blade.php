@extends('admin.dashboard')
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
                <a href="{{ route('admin.units.create') }}" class="btn btn-primary float-end btn-sm"><i
                        class="ri-add-box-fill"></i> Create Unit</a>
                <button type="button" class="btn btn-info btn-sm " data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    <i class="ri-filter-fill"> Filter </i>
                </button>
                <a href="{{ route('admin.units.index') }}" class="btn btn-primary btn-sm"><i class="ri-restart-line">
                        Restart</i></a>
                @include('admin.pages.unit._model_search')
            </div>
            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.units.actions') }}" method="post">
                    @csrf

                </form>
                <table class=" dt-responsive nowrap w-100 table table-bordered">
                    <thead>
                        <tr class="bluck-actions" style="display: none" scope="row">
                            <td colspan="8">
                                <div class="col-md-12 mt-0 mb-0 text-center">
                                    <button form="update-pages" class="btn btn-success btn-sm" type="submit"
                                        name="publish" value="1">
                                        <i class="ri-star-fill"></i>
                                    </button>
                                    <button form="update-pages" class="btn btn-warning btn-sm" type="submit"
                                        name="unpublish" value="1">
                                        <i class="ri-star-s-line"></i>
                                    </button>
                                    <button form="update-pages" class="btn btn-danger btn-sm" type="submit"
                                        name="delete_all" value="1">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 1px">
                                <input form="update-pages" class="checkbox-check flat cursor-pointer" type="checkbox"
                                    name="check-all" id="check-all" title="check-all">
                            </th>
                            <th>#</th>
                            <th>{{ __('image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Unit Code') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Building Number') }}</th>
                            <th>{{ __('Finance') }}</th>
                            <th>{{ __('Primum') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                            <tr class="text-center">
                                <td>
                                    <input form="update-pages" class="checkbox-check" type="checkbox"
                                        name="record[{{ $item->id }}]" value={{ $item->id }}>
                                </td>
                                <th>{{ $loop->iteration }}</th>
                                <td><img src="{{ asset($item->plan) }}" class="rounded" width="70" alt="">
                                </td>
                                <td>{{ optional($item->trans->where('locale', $current_lang)->first())->title }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ @$item->create_by->name }}</td>
                                <td>{{ @$item->building_number }}</td>
                                </td>
                                <td>
                                    @if ($item->finance == 1)
                                        <span class="badge badge-outline-warning">{{ __('Finance') }}</span>
                                    @else
                                        <span class=" badge badge-outline-danger">{{ __('Not Finance') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->primum == 1)
                                        <span class="badge badge-outline-warning">{{ __('Primum') }}</span>
                                    @else
                                        <span class=" badge badge-outline-danger">{{ __('Not Primum') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @if ($item->status == 1)
                                                <li>
                                                    <a href="{{ route('admin.units.update-status', $item->id) }}"
                                                        class="btn text-success  dropdown-item text-center fa-bold"
                                                        title="{{ __('Active') }}">
                                                        {{ __('Active') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('admin.units.update-status', $item->id) }}"
                                                        class="btn text-warning dropdown-item text-center fa-bold"
                                                        title="{{ __('Inactive') }}">
                                                        {{ __('Inactive') }}
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($item->for_sale == 1)
                                                <li>
                                                    <a href="{{ route('admin.units.for_sale', $item->id) }}"
                                                        class="btn text-success dropdown-item text-center fa-bold"
                                                        title="{{ __('Sold') }}">
                                                        {{ __('Sold') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('admin.units.for_sale', $item->id) }}"
                                                        class="btn text-warning dropdown-item text-center fa-bold"
                                                        title="{{ __('For Sale') }}">
                                                        {{ __('For Sale') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('admin.units.show', $item->id) }}"
                                                    class="btn text-pink dropdown-item text-center fa-bold"
                                                    title="{{ __('Show') }}">
                                                    {{ __('Show') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.units.edit', ['id' => $item->id, 'page' => request('page')]) }}"
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
                                        @include('admin.pages.unit._model_delete')
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">{{ __('No units found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end card body-->
            <div class="card-footer">
                <!-- Display pagination links -->
                {{ $products->links('vendor.pagination.bootstrap-4') }}
            </div>

        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

@section('script')
<script src="{{ asset('assets/admin/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/select2/js/select2.min.js') }}"></script>

@endsection