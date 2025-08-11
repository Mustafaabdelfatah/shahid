<div>
    <div class="col-lg-12">
        <label for="select2Multiple" class="form-label">{{ __('Country') }}<span
            class="text-danger">*</span></label>
        <select class="form-control w-100" id="select2Multiple"
        wire:model.live="selectCountry" name="country_id">
        <option >{{__("Select Country")}}</option>
            @foreach ($countries as $item)
                <option value="{{ $item->id }}">{{ $item->trans->where('locale',$current_lang)->first()->title }}</option>
            @endforeach
        </select>

    </div>

    <div class="col-lg-12 mt-2">
        <label for="select2Multiple" class="form-label">{{ __('States') }}</label>
        <select class="form-control w-100" id="select2Multiple" wire:model.live="selectState"
        name="state_id" >
            <option >{{__("Select State")}}</option>
            @if ($states)
                @foreach ($states as $item)
                    <option value="{{ $item->id }}">{{ @$item->trans->where('locale',$current_lang)->first()->title }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="col-lg-12 mt-2">
        <label for="select2Multiple" class="form-label">{{ __('City') }}</label>
        <select class="form-control w-100" id="select2Multiple"
        name="city_id" >
            <option disabled selected>{{__("Select City")}}</option>
            @if ($cities)
                @foreach ($cities as $item)
                    <option value="{{ $item->id }}">{{ @$item->trans->where('locale',$current_lang)->first()->title }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

