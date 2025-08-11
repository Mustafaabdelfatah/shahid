@extends('admin.dashboard')
@section('title', __('Packages'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Edit Packages') }}</h4>
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
                            <a href="{{ route('admin.packages.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.packages.update', $package->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
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
                                                @foreach ($languages as $index => $locale)
                                                    {{-- title ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="title{{ $index }}">{{ __('Title in ') . Locale::getDisplayName($locale) }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control" type="text"
                                                                name="{{ $locale }}[title]"
                                                                value="{{ old($locale . '.title', optional($package->trans()->where('locale', $locale)->first())->title) }}"
                                                                id="title{{ $index }}">
                                                            @if ($errors->has($locale . '.title'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="title{{ $index }}">{{ __('Description in ') . Locale::getDisplayName($locale) }}</label>
                                                            <textarea name="{{ $locale }}[description]" id="description{{ $index }}">{{ old($locale . '.description', optional($package->trans()->where('locale', $locale)->first())->description) }}</textarea>
                                                            @if ($errors->has($locale . '.description'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first($locale . '.description') }}</span>
                                                            @endif
                                                        </div>
                                                        <script type="text/javascript">
                                                            ClassicEditor
                                                                .create(document.querySelector('#description{{ $index }}'))
                                                                .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                            <button class="accordion-button fw-medium collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                                {{ __('Setting Packages') }}
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo" style>
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="type">{{ __('Type packege') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class=" form-control " id="type" name="type">
                                                                <option value="gold" @selected($package->type == 'gold')>
                                                                    {{ __('Gold') }}</option>
                                                                <option value="bronze" @selected($package->type == 'bronze')>
                                                                    {{ __('Bronze') }}</option>
                                                                <option value="silver" @selected($package->type == 'silver')>
                                                                    {{ __('Silver') }}</option>
                                                                <option value="normal" @selected($package->type == 'normal')>
                                                                    {{ __('Normal') }}</option>
                                                            </select>
                                                            @error('type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if (isset($package->package_data) && !empty($package->package_data))
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('Price') }}</th>
                                                                    <th>{{ __('Duration') }}</th>
                                                                    <th>{{ __('Action') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($package->package_data as $item)
                                                                    <tr>
                                                                        <td>{{ $item->price }}</td>
                                                                        <td>{{ $item->duration }}</td>
                                                                        <td>
                                                                            <a class="btn btn-danger btn-sm"
                                                                                href="{{ route('admin.packages.delete_data', $item->id) }}">
                                                                                <i class="bi bi-trash "></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                    <div id="repeater_video">
                                                        <!-- Repeater Heading -->
                                                        <div class="repeater-heading">
                                                            <button type="button"
                                                                class="btn btn-primary  pull-right repeater-add-btn float-end">
                                                                {{ __('Add') }}
                                                            </button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <!-- Repeater Items -->
                                                        <div class="items" data-group="list">
                                                            <!-- Repeater Content -->
                                                            <div class="item-content">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12 mb-3 mt-1">
                                                                        <label for="price"
                                                                            class="col-lg-2 control-label">{{ __('Price') }}</label>
                                                                        <div class="col-lg-10">
                                                                            <input type="number" class="form-control"
                                                                                id="price"
                                                                                placeholder="{{ __('Price') }}"
                                                                                data-skip-name="fales" data-name="price">
                                                                            @error('list.*.price')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 mb-3 mt-1">
                                                                        <label for="duration"
                                                                            class="col-lg-2 control-label">{{ __('Duration') }}</label>
                                                                        <div class="col-lg-10">
                                                                            <input type="number" class="form-control"
                                                                                id="duration"
                                                                                placeholder="{{ __('Duration') }}"
                                                                                data-skip-name="fales"
                                                                                data-name="duration">
                                                                            @error('list.*.duration')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Repeater Remove Btn -->
                                                            <div class="pull-right repeater-remove-btn">
                                                                <button class="btn btn-danger remove-btn mt-3">
                                                                    {{ __('Remove') }}
                                                                </button>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 mt-3">
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck3" name="status"
                                                                @checked($package->status == 1)>
                                                            <label class="form-check-label"
                                                                for="customCheck3">{{ __('Status') }}</label>
                                                        </div>
                                                    </div>

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
    <script src="{{ asset('assets/admin/js/repeater.js') }}" type="text/javascript"></script>
    <script>
        /* Create Repeater */
        $("#repeater_video").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>
@endsection
