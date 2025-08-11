@extends('admin.dashboard')
@section('title', __('contact'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('All Service Provided') }}</h4>
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
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('phone') }}</th>
                                <th>{{ __('service') }}</th>
                                <th>{{ __('Countent') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>


                            <tbody>
                                @forelse ($service_provided as $item)
                                    <tr>

                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ @$item->name }}</td>
                                        <td>{{ @$item->phone }}</td>
                                        <td>{{ @$item->service }}</td>
                                        <td>{{ @$item->content }}</td>
                                        <td>
                                            <div class=" d-flex  justify-content-around">

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#danger-header-modal{{ $item->id }}"
                                                    title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                            </div>

                                            @include('admin.pages.service_provided._model_delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center text-danger">No Messages</tr>
                                @endforelse
                            </tbody>
                    </table>

                </div> <!-- end card body-->
                {{-- <div class="col-md-12 d-flex flex justify-content-center align-items-center">
                {{ $contact->links('layouts.admin.pagination')}}
            </div> --}}
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
