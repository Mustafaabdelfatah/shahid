@extends('admin.dashboard')
@section('title', __('Unit Commint'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Create Unit Commint') }}</h4>
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
                            <a href="{{ route('admin.unit-commint.index') }}"
                                class="btn btn-primary float-end">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.unit-commint.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Date Range -->
                                <div class="mb-3">
                                    <label class="form-label" for="stars">{{__('Stars')}}</label>
                                    <input type="number" class="form-control" name="stars" id="stars" placeholder="{{__('Stars')}}" min="0" max="5" maxlength="5">
                                </div>
                                @error('stars')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
    
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="commint">{{__('commint')}}</label>
                                    <input type="text" class="form-control date" id="commint" name="commint"  value="{{old('commint')}}">
                                </div>
                                @error('commint')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

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
