<div>
    <div class="row">
        <div class="mt-2 col-lg-7">
            <label for="select2Multiple" class="form-label">{{ __('City') }}</label>
            <select class="form-control w-100" id="select2Multiple" name="city_id" wire:model.live="selectCity">
                <option>{{ __('Select City') }}</option>
                @if ($cities)
                    @foreach ($cities as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == $popularCity->country_id ? 'selected' : '' }}>
                            {{ @$item->trans->where('locale', $current_lang)->first()->title }}</option>
                    @endforeach
                @endif
            </select>
            @error('city_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 col-lg-5">
            <label for="select2Multiple" class="form-label">{{ __('Project') }}</label>
            <select class="form-control w-100" id="select2Multiple" name="project_id[]" multiple="multiple"
                wire:model="selectProject">
                <option disabled selected>{{ __('Select Unit') }}</option>
                @if ($projctes)
                    @foreach ($projctes as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->trans->where('locale', $current_lang)->first()->title }}</option>
                    @endforeach
                @endif
            </select>
            @error('project_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
