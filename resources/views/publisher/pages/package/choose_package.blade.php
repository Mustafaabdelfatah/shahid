@extends('publisher.dashboard')
@section('title', __('Choose Package'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Choose Package') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=" header-title">
                   {{__('Unit name is : ')}}     {{$unit->trans->where('locale', $current_lang)->first()->title}}
                    </h4>
                </div>
             
                <form action="{{ route('publisher.packages.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Date Range -->
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="unit_id" id="name"
                                        value="{{ $unit->id}}" >
                                </div>
                            </div>
                        </div>
                        @livewire('package-select')
                        <div class="d-flex flex-wrap gap-2 mt-1 float-end p-2">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            <a href="{{ route('publisher.advertisements.index') }}"
                                class="btn btn-secondary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </form>
                <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection
