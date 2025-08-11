@extends('admin.dashboard')
@section('title', __('Roles'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class=" page-title">{{ __('All Roles') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                @include('layouts.admin.message')
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-end">{{ __('Create') }}</a>

            </div>
            <div class="card-body">
                <form id="update-pages" action="{{ route('admin.roles.actions') }}" method="post">
                    @csrf

                </form>
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                        <tr class="bluck-actions" style="display: none" scope="row">
                            <td colspan="8">
                                <div class="col-md-12 mt-0 mb-0 text-center">
                                    {{-- <button form="update-pages" class="btn btn-success btn-sm" type="submit"
                                        name="publish" value="1"> <i class="ri-star-fill "></i></button>
                                    <button form="update-pages" class="btn btn-warning btn-sm" type="submit"
                                        name="unpublish" value="1"><i class="ri-star-s-line "></i></button> --}}
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
                        @forelse ($items as $key=> $item)
                        <tr>

                            <td>
                                @if ($item->id != 1)
                                <input form="update-pages" class="checkbox-check" type="checkbox"
                                    name="record[{{ $item->id }}]" value={{ $item->id }}>
                                @endif
                            </td>
                            <th>{{ $items->firstItem() + $key }}</th>
                            <td>{{ $item->name }}</td>

                            <td class="">
                                <div class="">
                                    <a href="{{ route('admin.roles.show', $item->id) }}" class="btn btn-primary btn-sm"
                                        title="{{ __('Edit') }}"><i class="ri-eye-line"></i></a>
                                    <a href="{{ route('admin.roles.edit', $item->id) }}" class="btn btn-primary btn-sm"
                                        title="{{ __('Edit') }}"><i class="ri-edit-line"></i></a>
                                    @if ($item->id != 1)
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#danger-header-modal{{$item->id}}" title="{{__('Delete')}}"><i
                                            class="ri-delete-bin-line"></i></button>
                                    @endif
                                </div>
                                @include('admin.pages.authorization.delete')
                            </td>
                        </tr>

                        <!-----------------Start Model Delete---------------------------------->
                        <!-----------------End Model Delete---------------------------------->
                        @empty
                        <td class="text-danger">
                            @lang('messages.admin.no_date')
                        </td>
                        @endforelse

                    </tbody>
                </table>
            </div> <!-- end card body-->
            <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $items->links('layouts.admin.pagination')}}
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
@section('script')

@endsection