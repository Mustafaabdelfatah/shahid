@extends('publisher.dashboard')
@section('title', __('My Ads'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('My Ads') }}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xxl-10">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Unit Title') }}</th>
                                                    <th>{{ __('Package') }}</th>
                                                    <th>{{ __('Duration Date') }}</th>
                                                    <th>{{ __('Start Date') }}</th>
                                                    <th>{{ __('End Date') }}</th>
                                                    <th class="text-end">{{ __('Price') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($unit_package as $item)
                                                    <tr>
                                                        <td class="">1</td>
                                                        <td>
                                                            {{ $item->product->trans->where('locale', $current_lang)->first()->title }}
                                                        </td>
                                                        <td>{{ $item->package->trans->where('locale', $current_lang)->first()->title }}
                                                        </td>
                                                        <td>{{ $item->date->duration }} </td>
                                                        <td>{{ $item->start_date }}</td>
                                                        <td>{{ $item->end_date }}</td>
                                                        <td>{{ $item->date->price }}</td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div> <!-- end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>
        </div> <!-- end col-->
    </div>
@endsection
