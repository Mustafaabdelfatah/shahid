<div id="danger-header-modal{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="p-4 modal-body">
                <div class="text-center">
                    <i class="ri-close-circle-line h1"></i>
                    <h4 class="mt-2">{{ __('Item  Delete') }}!</h4>
                    <p class="mt-3">{{ __('Are you Sure To Delete') }}</p>
                    <form action="{{ route('admin.popular-project.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="my-2 btn btn-light"
                            data-bs-dismiss="modal">{{ __('Continue') }}</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
