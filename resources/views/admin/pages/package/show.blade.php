@extends('admin.dashboard')
@section('title', __('Packages'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Details Package') }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                    <a href="{{ route('admin.packages.index') }}"
                        class="btn btn-primary float-end mt-4 btn-sm">{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Duration')}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($package->package_data as $item)
                                <tr>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->duration }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" href="{{route('admin.packages.delete_data',$item->id)}}">
                                            <i class="bi bi-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
