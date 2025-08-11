@extends('admin.dashboard')
@section('title',__('User'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{__('Show User')}}</h4>
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
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Date Range -->
                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="{{__('Name')}}" value="{{old('name',$user->name)}}" disabled>
                        </div>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label" for="email">{{__('Email')}}</label>
                            <input type="email" class="form-control date" id="email" name="email" value="{{old('email',$user->email)}}" disabled>
                        </div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <label class="form-label" for="password">{{__('Phone')}}</label>
                            <input type="text" class="form-control date" id="phone" name="phone" value="{{old('phone',$user->phone)}}" disabled>
                        </div>
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="customCheck3" name="status" @checked($user->status == 1 ) disabled>
                                <label class="form-check-label" for="customCheck3">{{__('Status')}}</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
             <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection
