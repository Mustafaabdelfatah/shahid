@extends('publisher.dashboard')
@section('title',__('Products'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{__('All Products')}}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Size') }}</th>
                            <th>{{ __('Sort') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $item->trans->where('locale',$current_lang)->first()->title }}</td>
                                <td>{{ $item->category->trans->where('locale',$current_lang)->first()->title }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->sort }}</td>
                                <td>
                                    <div class=" d-flex  justify-content-around">

                                <a href="{{ route('publisher.units.show', $item->id) }}"
                                    class="btn btn-pink btn-sm" title="{{ __('Show') }}"><i class="ri-eye-fill"></i></a>
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
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
