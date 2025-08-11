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
                    {{-- <li class="breadcrumb-item"><a href="#">{{$users->id}}</a></li> --}}
                    <li class="breadcrumb-item"><a href="{{ route('admin.buildings.index') }}">{{ __('Buildings') }}</a>
                    </li>
                    <li class="breadcrumb-item active text-info">{{ __('Create Building') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ __('Buildings') }}</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="{{ route('admin.buildings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-8">
                            @include('layouts.admin.message')
                        </div>
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
                                            {{-- title --------------------------------------------- --}}
                                            <div class="row mb-3">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="title{{ $index }}">{{ __('Title in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text"
                                                        name="{{ $locale }}[title]"
                                                        value="{{ old($locale . '.title') }}"
                                                        id="title{{ $index }}">
                                                    @if ($errors->has($locale . '.title'))
                                                    <span
                                                        class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label"
                                                    for="title{{ $index }}">{{ __('description in ') . Illuminate\Support\Facades\Lang::get($locale) }}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-12 mb-2">
                                                    <textarea id="description{{ $index }}" name="{{ $locale }}[description]"> {{ old($locale . '.description') }} </textarea>
                                                    @if ($errors->has($locale . '.description'))
                                                    <span
                                                        class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                    @endif
                                                </div>

                                                <script type="text/javascript">
                                                    CKEDITOR.replace('description{{ $index }}', {
                                                        filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                                                        filebrowserUploadMethod: 'form'
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="accordion" id="accordionPanelsStayOpenExampleTag">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse"
                                                    aria-expanded="false" aria-controls="panelsStayOpen-collapse">
                                                    {{ __('Setting portfolios') }}
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapse" class="accordion-collapse collapse show"
                                                aria-labelledby="panelsStayOpen-headingTwo" style>
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="cover">{{ __('Cover') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    id="cover" name="cover">
                                                                @if ($errors->has('cover'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('cover') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="image">{{ __('Images') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    id="image" name="image[]" multiple>
                                                                @if ($errors->has('image'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('image') }}</span>
                                                                @endif

                                                                @foreach ($errors->get('image.*') as $messages)
                                                                    @foreach ($messages as $message)
                                                                    <span
                                                                        class="text-danger">{{ $message }}</span>
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="user_id">{{ __('Developer name') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="user_id" id="user_id"
                                                                    class=" form-control">
                                                                    <option value="">{{ __('Select Developer') }}
                                                                    </option>
                                                                    @foreach ($users as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @selected(old('user_id')==$item->id)>
                                                                        {{ $item->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('user_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 ">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="address">{{ __('Address') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="address" name="address"
                                                                    value="{{ old('address') }}">
                                                                @error('address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-sm-12">
                                                            <label class="form-label"
                                                                for="address">{{ __('Delivery Year') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="delivery_date" id="delivery_date"
                                                                class="form-control">
                                                                <option value="">{{ __('Delivery Year') }}</option>
                                                                @for ($year = now()->year; $year <= now()->year + 15; $year++)
                                                                    <option value="{{ $year }}"
                                                                        {{ old('delivery_date', $product->delivery_date ?? '') == $year ? 'selected' : '' }}>
                                                                        {{ $year }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="delivery_date">{{ __('price') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="price" name="price"
                                                                    value="{{ old('price') }}">
                                                                @error('price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="delivery_date">{{ __('spaces') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input required type="text" class="form-control"
                                                                    id="spaces" name="spaces"
                                                                    value="{{ old('spaces') }}">
                                                                @error('spaces')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="map">{{ __('Map') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="map" name="map"
                                                                    value="{{ old('map') }}">
                                                                @error('map')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="method_payment">{{ __('Method Payment') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="method_payment" id="method_payment"
                                                                    class=" form-control">
                                                                    <option value="">
                                                                        {{ __('Select Method Payment') }}
                                                                    </option>
                                                                    <option value="cash_money"
                                                                        @selected(old('method_payment')=='cash_money' )>
                                                                        {{ __('Cash Money') }}
                                                                    </option>
                                                                    <option value="installment"
                                                                        @selected(old('method_payment')=='installment' )>
                                                                        {{ __('Installment') }}
                                                                    </option>
                                                                    <option value="cash_and_insatllment"
                                                                        @selected(old('method_payment')=='cash_and_insatllment' )>
                                                                        {{ __('Cash And Insatllment') }}
                                                                    </option>
                                                                </select>
                                                                @error('method_payment')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="construction_status">{{ __('Construction Status') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="construction_status"
                                                                    id="construction_status" class=" form-control">
                                                                    <option value="">
                                                                        {{ __('Select Construction Status') }}
                                                                    </option>
                                                                    <option value="under_construction"
                                                                        @selected(old('construction_status')=='under_construction' )>
                                                                        {{ __('Under Construction') }}
                                                                    </option>
                                                                    <option value="sent_delivered"
                                                                        @selected(old('construction_status')=='sent_delivered' )>
                                                                        {{ __('Completed') }}
                                                                    </option>
                                                                </select>
                                                                @error('construction_status')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="finish_type">{{ __('Finish Type') }}</label>
                                                                <select required class=" form-control" id="Finishing_type"
                                                                    name="finish_type">
                                                                    <option>{{ __('Select Method') }}</option>
                                                                    <option value="core_and_shell">{{ __('Core And Shell') }}</option>
                                                                    <option value="half_finished">{{ __('Half Finished') }}</option>
                                                                    <option value="fully_finished">{{ __('Fully Finished') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 mt-3">
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheck3" name="status"
                                                                    @checked(old('status'))>
                                                                <label class="form-check-label"
                                                                    for="customCheck3">{{ __('Status') }}</label>
                                                            </div>

                                                        </div>
                                                        <div class="mt-3 col-sm-6">
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="FinanceCheck" name="finance">
                                                                <label class="form-check-label"
                                                                    for="FinanceCheck">{{ __('هل يصلح للتمويل العقاري ') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mt-2 accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="property-accordion-header">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#property-accordion-content" aria-expanded="false"
                                                    aria-controls="property-accordion-content">
                                                    {{ __('Facilities') }}
                                                </button>
                                            </h2>
                                            <div id="property-accordion-content" class="accordion-collapse collapse"
                                                aria-labelledby="property-accordion-header">
                                                <div class="accordion-body">
                                                    <div class="mb-3">

                                                        <div class="row">
                                                            @foreach ($propertys as $item)
                                                            <div class="col-md-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        type="checkbox"
                                                                        value="{{ $item->id }}"
                                                                        id="property-{{ $item->id }}"
                                                                        name="properties[]">
                                                                    <label class="form-check-label"
                                                                        for="property-{{ $item->id }}">
                                                                        {{ $item->trans->where('locale', $current_lang)->first()->title }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            @error('properties')
                                            <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                            @enderror
                                            @error('properties.*')
                                            <span class="mt-1 p-1 text-danger">{{ $message }}</span>
                                            @enderror
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
@endsection