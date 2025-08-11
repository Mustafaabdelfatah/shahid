@extends('admin.dashboard')
@section('title', __('Teams'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Create Team') }}</h4>
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
                            <a href="{{ route('admin.teams.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.teams.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                                {{ __('Title') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingOne" style>
                                            <div class="accordion-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">{{ __('Title') }}</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        value="{{ old('title') }}">
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                                {{ __('Team Details') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">

                                                <div class="mb-3">
                                                    <label for="Mangers" class="form-label">{{ __('Mangers') }}</label>
                                                    <select class="form-control" id="Mangers" name="manger_id">
                                                        <option selected disabled>{{ __('Choose Mangers') }} ...</option>
                                                        @foreach ($mangers as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                                |{{ $item->email }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('manger_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select2Multiple"
                                                        class="form-label">{{ __('Employees') }}</label>
                                                    <select class="select2 form-control select2-multiple"
                                                        data-toggle="select2" id="select2Multiple" multiple="multiple"
                                                        data-placeholder="{{ __('Choose Employees') }} ..."
                                                        name="employees[]">
                                                        @foreach ($employees as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}  |{{ $item->email }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('employees.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3"
                                                        name="status">
                                                    <label class="form-check-label"
                                                        for="customCheck3">{{ __('Status') }}</label>
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
