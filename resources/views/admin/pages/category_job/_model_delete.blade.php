<div id="danger-header-modal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="ri-close-circle-line h1"></i>
                    <h4 class="mt-2">{{__('Item Delete')}}!</h4>
                    <p class="mt-3">{{__('Are you Sure To Delete')}}</p>
                    <form action="{{route('admin.category_job.destroy',$item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-light my-2"
                            data-bs-dismiss="modal">{{__('Continue')}}</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>