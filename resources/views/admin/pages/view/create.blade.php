@extends('admin.dashboard')
@section('title', __('View'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Create View') }}</h4>
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
                            <a href="{{ route('admin.user_view.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.user_view.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                                {{ __('Details') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">

                                                <div class="mb-3">
                                                    <label for="Product" class="form-label">{{ __('Products') }}</label>
                                                    <select class="form-control" id="Product" name="product_id">
                                                        <option selected disabled>{{ __('Choose Product') }} ...</option>
                                                        @foreach ($product as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->trans()->where('locale', $current_lang)->first()->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('manger_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select2Multiple"
                                                        class="form-label">{{ __('Users') }}</label>
                                                    <select class="select2 form-control select2-multiple"
                                                        data-toggle="select2" id="select2Multiple" multiple="multiple"
                                                        data-placeholder="{{ __('Choose User') }} ..." name="user_id">
                                                        @foreach ($user as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('users.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        $('.select2-multiple').select2({
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endsection
