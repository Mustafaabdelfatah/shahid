@extends('admin.dashboard')
@section('title', __('Roles'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class=" page-title">{{ __('Edit Role') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
                    @include('layouts.admin.message')
                </div>
                <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Role Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $role->name }}">
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="permissions" class="form-label">{{ __('Permissions') }}</label>
                                <div id="permissions" class="row">
                                    @foreach ($permissions as $item)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $item->name }}"
                                                    id="permission{{ $item->id }}" name="permissions[]"
                                                    {{ $role->permissions->contains('id', $item->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission{{ $item->id }}">
                                                    {{ transPermission($item->name) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                        </div>
                    </div>
                </form>
                <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

@endsection
@section('script')
    <!-- Multi Select Plugin Js -->
    <script>
        $('.multiple-select').select2({
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endsection
