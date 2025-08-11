@extends('admin.dashboard')
@section('title', __('Popular'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Create Popular City And Units') }}</h4>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <div class="card w-100">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            @include('layouts.admin.message')
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.popular_cities.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.popular_cities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            @livewire('popular-city')
                            <div class="col-md-12">
                                <div class="form-check mt-3 form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="customCheck3" name="status">
                                    <label class="form-check-label" for="customCheck3">{{ __('Status') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1 justify-content-end p-2">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div> <!-- end card-->
        </div>
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
