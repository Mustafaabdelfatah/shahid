@extends('admin.dashboard')
@section('title', __('Buildings'))
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.buildings.index') }}">{{ __('Buildings') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.buildings.edit',$project->id) }}">{{
                            $project->trans->where('locale', $current_lang)->first()->title
                            }}</a>
                    </li>
                        <li class="breadcrumb-item active text-info">{{ __('Create Installments') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('Buildings') }}</h4>
            </div>
        </div>
    </div>
    {{-- project_id --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('layouts.admin.message')
                <form action="{{ route('admin.buildings_installments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Hidden Input for Project ID -->
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <!-- Input for Down Payment -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">{{ __('Price Unit') }}</label>
                                    <input type="number" step="0.01" id="price" name="price"
                                        class="form-control @error('price')  @enderror" value="{{ $project->price }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">{{ __('Deposit') }}</label>
                                    <input type="number" step="0.01" id="deposit" name="deposit"
                                        class="form-control @error('deposit') is-invalid @enderror" value="{{ old('deposit') }}"
                                        required>
                                    @error('deposit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Input for Years -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="years">{{ __('Years Count') }}</label>
                                    <input type="number" id="years" name="years"
                                        class="form-control @error('years') is-invalid @enderror" value="{{ old('years') }}"
                                        required>
                                    @error('years')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
    @include('admin.pages.project.installment._table')
@endsection
@section('script')
@endsection
