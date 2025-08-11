@extends('publisher.dashboard')
@section('title', __('Roles'))
@section('style')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class=" page-title">{{ __('Show Role') }}</h4>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="m-1">
                    <a class="btn btn-primary float-end" href="{{ route('publisher.roles.index') }}">{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            @foreach ($role->permissions->sortBy('name') as $key => $item)
                                <div class="col-md-3">

                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                            id="flexCheckSuccess{{ $key }}" name="permissions[]"
                                            {{ $role->permissions->contains('id', $item->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckSuccess{{ $key }}">
                                            {{ transWebPermission($item->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Multi Select Plugin Js -->
@endsection
