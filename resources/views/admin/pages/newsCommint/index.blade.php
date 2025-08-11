@extends('admin.dashboard')
@section('title',__('News Commint'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{__('All News Commint')}}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.news-commint.create') }}" class="btn btn-primary float-end">{{ __('Create News Commint') }}</a>

            </div>
            <div class="card-body">
                
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('news Id') }}</th>
                            <th>{{ __('Stars Count') }}</th>
                            <th>{{ __('User Name') }}</th>
                            <th>{{ __('User Email') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($newsCommint as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{  $item->news->trans->where('locale',$current_lang)->first()->title }}</td>
                                <td>{{  $item->stars}}</td>
                                <td>{{  @$item->user->name}}</td>
                                <td>{{  @$item->user->email}}</td>
                                <td>
                                    <div class=" d-flex  justify-content-around">   
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#danger-header-modal{{ $item->id }}"
                                            title="{{ __('Delete') }}"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                    @include('admin.pages.newsCommint._model_delete')
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
