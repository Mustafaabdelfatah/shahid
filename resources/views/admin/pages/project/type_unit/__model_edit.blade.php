<div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Edit Type Unit')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.type-units.update',$item->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $project->id }}" name="project_id">
                    
                    <div class="row">
                        @foreach ($languages as $index => $locale)
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="title{{ $index }}">
                                    {{ __('Title in') . Illuminate\Support\Facades\Lang::get($locale) }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="{{ $locale }}[title]"
                                value="{{ old($locale . '.title', optional($item->trans()->where('locale', $locale)->first())->title) }}">
                                @if ($errors->has($locale . '.title'))
                                <span class="text-danger">{{ $errors->first($locale . '.title') }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Edit')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>