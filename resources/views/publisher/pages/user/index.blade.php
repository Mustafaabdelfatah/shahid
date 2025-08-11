@extends('publisher.dashboard')
@section('title',__('Users'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class=" page-title">{{__('All Users')}}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{route('publisher.users.create')}}" class="btn btn-primary float-end">{{__('Add User')}}</a>
            </div>
            <div class="card-body">
                <table id="datatable-buttons"
                    class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item )
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>
                                <div class=" d-flex  justify-content-around">
                                    @if ($item->status == 1)
                                    <a href="{{ route('publisher.users.update-status', $item->id) }}"
                                        class="btn btn-outline-success btn-sm" title="{{__('Active')}}"><i class="ri-star-fill "></i></a>
                                @else
                                    <a href="{{ route('publisher.users.update-status', $item->id) }}"
                                        class="btn btn-outline-warning btn-sm" title="{{__('Inactive')}}"><i class="ri-star-s-line "></i></a>
                                @endif
                                    <a href="{{route('publisher.users.edit',$item->id)}}"
                                        class="btn btn-primary btn-sm" title="{{__('Edit')}}"><i class="ri-edit-line"></i></a>

                                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$item->id}}" title="{{__('Delete')}}"><i class="ri-delete-bin-line"></i></button>
                                </div>
                                @include('publisher.pages.user._model_delete')
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
