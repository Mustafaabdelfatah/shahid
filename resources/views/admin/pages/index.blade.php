@extends('admin.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-warning">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-group-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Clients') }}</h6>
                            <h2 class="my-2">{{ $clients }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-danger">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-group-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Brokers') }}</h6>
                            <h2 class="my-2">{{ $brokers }}</h2>

                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-secondary">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-admin-fill widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Agency') }}</h6>
                            <h2 class="my-2">{{ $agencies }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-info">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-group-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Unit Onwer') }}</h6>
                            <h2 class="my-2">{{ $unit_onwer }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-warning">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-community-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Units') }}</h6>
                            <h2 class="my-2">{{ $units }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                {{-- <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-danger">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-projector-line idget-icon widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Projects') }}</h6>
                            <h2 class="my-2">{{ $projects }}</h2>
                        </div>
                    </div>
                </div> <!-- end col--> --}}
{{--
                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-secondary">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-product-hunt-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Published Units') }}</h6>
                            <h2 class="my-2">{{ $published_products }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-info">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-product-hunt-fill widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Unpublished Units') }}</h6>
                            <h2 class="my-2">{{ $unpublished_products }}</h2>
                        </div>
                    </div>
                </div> <!-- end col--> --}}

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-danger">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-product-hunt-fill widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Teams') }}</h6>
                            <h2 class="my-2">{{ $team }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-secondary">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-store-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('Categories') }}</h6>
                            <h2 class="my-2">{{ $categories }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

                {{-- <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-secondary">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-checkbox-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">
                                {{ __('Agence OR Broker Approved Units') }}</h6>
                            <h2 class="my-2">{{ $approved_products }}</h2>
                        </div>
                    </div>
                </div> <!-- end col--> --}}

                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-info ">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-newspaper-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">{{ __('services') }}</h6>
                            <h2 class="my-2">{{ $services }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->

            </div>
            <!-- end row -->
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
    @endsection
    @section('script')
        {{-- <script src="{{ $chart->cdn() }}"></script>
        <script src="{{asset('assets/admin/vendor/apexcharts/apexcharts.min.js')}}"></script>
        {{ $chart->script() }} --}}
    @endsection
