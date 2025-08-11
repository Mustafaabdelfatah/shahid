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
                <form action="{{ route('publisher.units.index') }}" method="get">
                    <div class="row mt-3">
                        <div class="col-md-12 mt-1">
                            <input type="text" value="{{ request()->title != '' ? request()->title : '' }}" name="title"
                                placeholder="{{ trans('Search by title') }}" class="form-control">
                        </div>
                        <div class="col-md-12 mt-1">
                            <select class="select form-control select2 " name="type">
                                <option selected value="">{{ __('Unit Type') }}</option>
                                <option value="rent">{{ __('Rent') }}</option>
                                <option value="sale">{{ __('Sale') }}</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-1">
                            <select class="select form-control select2 " name="category_id">
                                <option selected value="">{{ __('Categories') }}</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">
                                    {{ @$item->trans()->where('locale', $current_lang)->first()->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mt-1">
                            <input type="text" value="{{ request()->code != '' ? request()->code : '' }}" name="code"
                                placeholder="{{ trans('Search by Code') }}" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <a class="btn btn-purple btn-sm" href="{{ route('publisher.units.prodcut_active') }}"><i
                                    class="ri-product-hunt-line"></i> {{ __('All Units Active') }}</a>
                            <a class="btn btn-danger btn-sm" href="{{ route('publisher.units.prodcut_inactive') }}"><i
                                    class="ri-product-hunt-line"></i> {{ __('All Units UnActive') }}</a>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>

                            <button type="submit" class="btn btn-primary btn-sm">
                                {{ __('Search') }}
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