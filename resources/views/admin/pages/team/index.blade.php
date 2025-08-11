@extends('admin.dashboard')
@section('title',__('Teams'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">{{__('All Teams')}}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.teams.create') }}" class="btn btn-primary float-end">{{ __('Create Team') }}</a>

            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Team Manger') }}</th>
                            <th>{{ __('Team Count') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teamss as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{  @$item->title }}</td>
                                <td>{{  @$item->user->name}}</td>
                                <td>
                                    <a href="{{route('admin.teams.show',$item->id)}}" class="btn btn-primary btn-sm text-center"  title="{{ __('Count Team') }}"><i class="ri-team-fill"></i> {{  @$item->teams->count()}} </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('Settings') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ route('admin.teams.edit', $item->id) }}"
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
                                        @include('admin.pages.team._model_delete')
                                    </div>
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
