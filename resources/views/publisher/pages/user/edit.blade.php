@extends('publisher.dashboard')
@section('title', __('Users'))
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class=" page-title">{{ __('Edit User') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header row">
                <div class="col-md-8">
                    @include('layouts.admin.message')
                </div>
                <div class="col-md-4">
                    <a href="{{ route('publisher.users.index') }}" class="btn btn-primary float-end">{{ __('Back')
                        }}</a>
                </div>
            </div>
            <form action="{{ route('publisher.users.update', $user->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Date Range -->
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}">
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">{{ __('Email') }}</label>
                                <input type="text" class="form-control date" id="email" name="email"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <input type="text" class="form-control date" id="password" name="password">
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label" for="password">{{ __('Phone') }}</label>
                                <input type="number" class="form-control date" id="password" name="phone"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="customCheck3" name="status"
                                        @checked($user->status == 1)>
                                    <label class="form-check-label" for="customCheck3">{{ __('Status') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                        <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                    </div>
                </div>
            </form>
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection
@section('script')
<!-- Multi Select Plugin Js -->
<script>
    $('.select2-multiple').select2({
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
</script>
@endsection