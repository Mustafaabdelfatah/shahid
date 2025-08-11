@extends('publisher.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
@if (auth()->user()->role === 'employee')
<div style="text-align: center; margin-top: 3rem;">
    <h1 class="mt-5" style="color: rgb(126, 126, 241);">' WELCOME {{ auth()->user()->name }} This is your Dashboard '</h1>
</div>

@else ()
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row mt-3">

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-pink">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-group-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Teams') }}</h6>
                            <h2 class="my-2">{{ __('Teams') }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-info">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-community-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Employee') }}</h6>
                            <h2 class="my-2">{{ __('Employee') }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-danger">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-store-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Units') }}</h6>
                            <h2 class="my-2">{{ __('Units') }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-warning">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-store-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Sponsored ads') }}</h6>
                            <h2 class="my-2">{{ __('Sponsored') }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

            </div> <!-- end row-->

            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#weeklysales-collapse" role="button"
                                    aria-expanded="true" aria-controls="weeklysales-collapse" class=""><i
                                        class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">{{ __('Weekly Clients Report') }}</h5>

                            <div id="weeklysales-collapse" class="pt-3 collapse show" style="">
                                {!! $chart->container() !!}
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> --}}
        </div>
        <!-- container -->
    </div>
    @endif
@endsection
