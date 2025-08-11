@extends('publisher.dashboard')
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
                <div class="row">
                    <div class="col-md-8">
                        @include('layouts.admin.message')
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('publisher.roles.index') }}"
                            class="btn btn-primary float-end">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('publisher.roles.update',$role->id) }}" method="post">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{__('Role Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="select2Multiple" class="form-label">{{ __('Permissions') }}</label>
                            <select class="select2 form-control multiple-select" data-toggle="select2" id="select2Multiple"
                                multiple="multiple" data-placeholder="{{__('Choose Permissions')}} ..."  name="permissions[]">
                                @foreach ($permissions as $item)
                                    <option value="{{ $item->name }}"  {{ $role->permissions->contains('id', $item->id) ?
                                        'selected' : '' }}>{{ transWebPermission($item->name) }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                        <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>

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
