@extends('admin.dashboard')
@section('title', __('Settings'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class=" page-title">{{ __('Setting WebSite') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.admin.message')
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.setting.website.update',$setting->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="logo_web" class="form-label">{{__('Logo Website')}}</label>
                                                        <input type="file" class="form-control" id="logo_web" name="logo_web">
                                                    </div>
                                                    @if ($setting->logo_web)
                                                    <img src="{{ $setting->logo_web}}" width="200">
                                                @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="favicon_web" class="form-label">{{__('Favicon Website')}}</label>
                                                        <input type="file" class="form-control" id="favicon_web" name="favicon_web">
                                                    </div>
                                                    @if ($setting->favicon_web)
                                                    <img src="{{$setting->favicon_web }}" width="200">
                                                @endif
                                                </div>

                                                <!-- Add other input fields similarly -->
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">{{__('Title')}}</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $setting->name)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">{{__('Email Website')}}</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{old('email', $setting->email)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">{{__('Phone Website')}}</label>
                                                        <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone', $setting->phone)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="facebook" class="form-label">{{__('Facebook')}}</label>
                                                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{old('facebook', $setting->facebook)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="twitter" class="form-label">{{__('Twitter')}}</label>
                                                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{old('twitter', $setting->twitter)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="instagram" class="form-label">{{__('Instagram')}}</label>
                                                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{old('instagram', $setting->instagram)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="linkedin" class="form-label">{{__('Linkedin')}}</label>
                                                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{old('linkedin', $setting->linkedin)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="whatsapp" class="form-label">{{__('Whatsapp')}}</label>
                                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{old('whatsapp', $setting->whatsapp)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="telegram" class="form-label">{{__('Telegram')}}</label>
                                                        <input type="text" class="form-control" id="telegram" name="telegram" value="{{old('telegram', $setting->telegram)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="github" class="form-label">{{__('Github')}}</label>
                                                        <input type="text" class="form-control" id="github" name="github" value="{{old('github', $setting->github)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="vimeo" class="form-label">{{__('Vimeo')}}</label>
                                                        <input type="text" class="form-control" id="vimeo" name="vimeo" value="{{old('vimeo', $setting->vimeo)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="tiktok" class="form-label">{{__('Tiktok')}}</label>
                                                        <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{old('tiktok', $setting->tiktok)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="snapchat" class="form-label">{{__('Snapchat')}}</label>
                                                        <input type="text" class="form-control" id="snapchat" name="snapchat" value="{{old('snapchat', $setting->snapchat)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="pinterest" class="form-label">{{__('Pinterest')}}</label>
                                                        <input type="text" class="form-control" id="pinterest" name="pinterest" value="{{old('pinterest', $setting->pinterest)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="map" class="form-label">{{__('Map')}}</label>
                                                        <input type="text" class="form-control" id="pinterest" name="map" value="{{old('map', $setting->map)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">{{__('Address Website')}}</label>
                                                        <textarea name="address" id="address" class="form-control">{{old('address', $setting->address)}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingAds">
                                        <button class="accordion-button fw-medium collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseAds"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseAds">
                                            {{ __('Meta') }}
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseAds" class="accordion-collapse collapse show "
                                        aria-labelledby="panelsStayOpen-headingAds" style>
                                        <div class="accordion-body">
                                            @foreach ($languages as $index => $locale)
                                                {{-- title ------------------------------------------------------------------------------------- --}}
                                                <div class="row mb-3">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="meta_title{{ $index }}">{{ __('Meta Title ') . Illuminate\Support\Facades\Lang::get($locale) }}</label>
                                                        <input class="form-control" type="text"
                                                            name="{{ $locale }}[meta_title]"
                                                            value="{{ old($locale . '.meta_title', optional($setting->trans()->where('locale', $locale)->first())->meta_title) }}"
                                                            id="meta_title{{ $index }}">
                                                        @if ($errors->has($locale . '.meta_title'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first($locale . '.meta_title') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="meta_description{{ $index }}">{{ __('Meta Description ') . Illuminate\Support\Facades\Lang::get($locale) }}</label>
                                                        <textarea name="{{ $locale }}[meta_description]" class="form-control description"
                                                            id="meta_description{{ $index }}"> {{ old($locale . '.meta_description', optional($setting->trans()->where('locale', $locale)->first())->meta_description) }} </textarea>
                                                        @if ($errors->has($locale . '.meta_description'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first($locale . '.meta_description') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="meta_key{{ $index }}">{{ __('Meta Keywords ') . Illuminate\Support\Facades\Lang::get($locale) }}</label>
                                                        <textarea name="{{ $locale }}[meta_key]" class="form-control description" id="meta_key{{ $index }}"> {{ old($locale . '.meta_key', optional($setting->trans()->where('locale', $locale)->first())->meta_key) }}</textarea>
                                                        @if ($errors->has($locale . '.meta_key'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first($locale . '.meta_key') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <button type="submit" class="btn btn-primary float-end">{{__("Edit")}}</button>

            </form>
        </div>
    </div>

@endsection
@section('script')


@endsection
