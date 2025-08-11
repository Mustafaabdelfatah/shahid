@extends('publisher.dashboard')
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
                    <div class="row">
                        <div class="col-md-8">
                            @include('layouts.admin.message')
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('publisher.roles.create') }}"
                                class="btn btn-primary float-end">{{ __('Create') }}</a>
                        </div>
                    </div>
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
                            @forelse ($items as $key=> $item)
                                <tr>
                                    <th>{{ $items->firstItem() + $key }}</th>
                                    <td>{{ $item->name }}</td>

                                    <td class="">
                                        <div class="">
                                            <a href="{{ route('publisher.roles.show', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i class="ri-eye-line"></i></a>
                                                    <a href="{{ route('publisher.roles.edit', $item->id) }}"
                                                        class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                                            class="ri-edit-line"></i></a>
                                            @if ($item->id != 1)
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$item->id}}" title="{{__('Delete')}}"><i class="ri-delete-bin-line"></i></button>
                                            @endif
                                        </div>
                                        @include('publisher.pages.authorization.delete')
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
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
@section('script')

@endsection
