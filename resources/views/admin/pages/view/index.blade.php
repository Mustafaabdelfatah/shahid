@extends('admin.dashboard')
@section('title',__('View'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{__('All Views')}}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.user_view.create') }}" class="btn btn-primary float-end">{{ __('Create View') }}</a>

            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('product') }}</th>
                            <th>{{ __('user') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user_view as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{  $item->product->trans()->where('locale', $current_lang)->first()->title }}</td>
                                <td>{{  @$item->user->name}}</td>
                                <td>
                                    <div class=" d-flex  justify-content-around">   
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#danger-header-modal{{ $item->id }}"
                                            title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                    @include('admin.pages.view._model_delete')
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
