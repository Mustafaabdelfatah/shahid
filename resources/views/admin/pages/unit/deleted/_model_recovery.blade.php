<div id="success-alert-modal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-success">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="ri-check-line h1"></i>
                    <h4 class="mt-2">{{__('Recover deleted items')}}</h4>
                    <p class="mt-3">{{__('Do you want to recover deleted files?')}}</p>
                    <form action="{{ route('admin.units.restore', $item->id) }}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-light my-2" data-bs-dismiss="modal">{{ __('Continue')
                            }}</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
