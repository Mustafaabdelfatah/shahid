@extends('publisher.dashboard')
@section('title', __('Teams'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Edit Team') }}</h4>
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
                            <a href="{{ route('publisher.teams.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('publisher.teams.update', $team->id) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                                                        value="{{ old('title',$team->title) }}">
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
                                                    <label for="select2Multiple"
                                                        class="form-label">{{ __('Employees') }}</label>
                                                    <select class="select2 form-control select2-multiple"
                                                        data-toggle="select2" id="select2Multiple" multiple="multiple"
                                                        data-placeholder="{{ __('Choose Employees') }} ..."
                                                        name="employees[]">
                                                        @foreach ($members as $item)
                                                            <option value="{{ $item->id }}"   {{ in_array($item->id, old('employees') ?? @$team->teams->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $item->name }}  |{{ $item->email }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('employees.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3"
                                                        name="status" @checked($team->status == 1)>
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
        $('.select2-multiple').select2({
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endsection
