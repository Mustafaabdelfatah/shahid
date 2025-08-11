@extends('admin.dashboard')
@section('title', __('Users'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{__('Create Users')}}</h4>
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
                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-primary float-end">{{ __('Back') }}</a>
                    </div>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- Date Range -->
                                <div class="mb-3">
                                    <label class="form-label" for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="{{__('Name')}}" value="{{old('name')}}">
                                </div>
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="email">{{__('Email')}}</label>
                                    <input type="text" class="form-control date" id="email" name="email"
                                        value="{{old('email')}}">
                                </div>
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">{{__('phone')}}</label>
                                    <input type="number" class="form-control date" id="phone" name="phone"
                                        value="{{old('phone')}}">
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="backup_number">{{__('backup_number')}}</label>
                                    <input type="number" class="form-control date" id="backup_number" name="backup_number"
                                        value="{{old('backup_number')}}">
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label class="form-label" for="password">{{__('Password')}}</label>
                                    <input type="text" class="form-control date" id="password" name="password">
                                </div>
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="select2Multiple" class="form-label">{{ __('Roles') }}</label>
                                <select class=" form-control" id="select2Multiple" name="role">
                                    <option selected disabled>{{__('Select Roles')}}</option>
                                    <option value="unit_onwer">{{__('Unit Onwer')}}</option>
                                    <option value="broker">{{__('Broker')}}</option>
                                    <option value="client">{{__('Client')}}</option>
                                    <option value="agency">{{__('Agency')}}</option>
                                    <option value="employee">{{__('Employee')}}</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-2">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="customCheck3" name="status">
                                        <label class="form-check-label" for="customCheck3">{{__('Status')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                            <button type="submit" class="btn btn-primary">{{__('Save User')}}</button>
                        </div>
                    </div>
                </form>
                <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    @endsection