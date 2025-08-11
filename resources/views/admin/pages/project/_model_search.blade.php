<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ __('Search form') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- end modal header -->
            <div class="modal-body">
                <form action="{{ route('admin.buildings.index') }}" method="get">
                    <div class="row mt-3">
                        <div class="col-md-12 mt-1">
                            <label for="title">{{ __('Search by title') }}</label>
                            <input type="text" id="title" value="{{ request()->title ?? '' }}" name="title"
                                placeholder="{{ trans('Search by title') }}" class="form-control">
                        </div>
                     
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="start_date">{{ __('Start Date') }}</label>
                            <input type="date" id="start_date" value="{{ request()->start_date ?? '' }}" name="start_date"
                                placeholder="{{ trans('Start Date') }}" class="form-control">
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="end_date">{{ __('End Date') }}</label>
                            <input type="date" id="end_date" value="{{ request()->end_date ?? '' }}" name="end_date"
                                placeholder="{{ trans('End Date') }}" class="form-control">
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="price_min">{{ __('Minimum Price') }}</label>
                            <input type="number" step="0.01" id="price_min" value="{{ request()->price_min ?? '' }}" name="price_min"
                                placeholder="{{ trans('Minimum Price') }}" class="form-control">
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="price_max">{{ __('Maximum Price') }}</label>
                            <input type="number" step="0.01" id="price_max" value="{{ request()->price_max ?? '' }}" name="price_max"
                                placeholder="{{ trans('Maximum Price') }}" class="form-control">
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="construction_status">{{ __('Construction Status') }}</label>
                            <select class="form-control" id="construction_status" name="construction_status">
                                <option selected value="">@lang('Construction Status')</option>
                                <option value="under_construction" {{ request()->input('construction_status') == 'under_construction' ? 'selected' : '' }}>
                                    @lang('Under Construction')
                                </option>
                                <option value="sent_delivered" {{ request()->input('construction_status') == 'sent_delivered' ? 'selected' : '' }}>
                                    @lang('Sent Delivered')
                                </option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="method_payment">{{ __('Payment Method') }}</label>
                            <select class="form-control" id="method_payment" name="method_payment">
                                <option selected value="">@lang('Payment Method')</option>
                                <option value="cash_money" {{ request()->input('method_payment') == 'cash_money' ? 'selected' : '' }}>
                                    @lang('Cash Money')
                                </option>
                                <option value="installment" {{ request()->input('method_payment') == 'installment' ? 'selected' : '' }}>
                                    @lang('Installment')
                                </option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <label for="delivery_date">{{ __('Delivery Date') }}</label>
                            <input type="date" id="delivery_date" value="{{ request()->delivery_date ?? '' }}" name="delivery_date"
                                placeholder="{{ trans('Delivery Date') }}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="fa-regular fa-rectangle-xmark"></i> {{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-brands fa-searchengin"></i> {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal content -->
    </div>
    <!-- end modal dialog -->
</div>
