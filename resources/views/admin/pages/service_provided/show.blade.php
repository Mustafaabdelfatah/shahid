@extends('admin.dashboard')
@section('title', __('Contacts'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Show Contacts') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                @include('layouts.admin.message')
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary float-end">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-justified nav-bordered mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active"
                            aria-selected="false" role="tab" tabindex="-1">
                            {{ __('Info contact') }}
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active show" id="home-b2" role="tabpanel">
                        <ul class="list-group">
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Name') }}</h5>
                                    {{ $contact->name }}
                                </div>
                                <div class="col-md-4 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Massage') }}</h5>
                                    {!! $contact->message !!}
                                </div>
                            </div>
                            <div class="row  d-flex  justify-content-center">
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Email') }}</h5>
                                    {{ $contact->email }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Phone') }}</h5>
                                    {{ $contact->phone }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Subject') }}</h5>
                                    {{ $contact->subject }}
                                </div>
                                <div class="col-md-3 list-group-item m-1">
                                    <h5 class="text-success">{{ __('Website') }}</h5>
                                    {!! $contact->website !!}
                                </div>
                            </div>
                        </ul>
                        </ul>
                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>
    @endsection
</div>
