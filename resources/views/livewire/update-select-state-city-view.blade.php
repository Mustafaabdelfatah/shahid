<div>
   
    <div class="col-lg-12">
        <label for="select2Multiple" class="form-label">{{ __('Country') }}</label>
        <select class="form-control w-100" id="select2Multiple"
        wire:model.live="selectCountry" name="country_id">
            <option disabled selected>{{__("Choose Country")}}</option>
            @foreach ($countries as $item)
                <option value="{{ $item->id }}" {{  $item->id == $cities->country_id ? 'selected' : '' }}>{{ $item->trans->where('locale',$current_lang)->first()->title }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-lg-12 mt-2">
        <label for="select2Multiple" class="form-label">{{ __('States') }}</label>
        <select class="form-control w-100" id="select2Multiple"
        name="state_id" >
            <option disabled selected>{{__("Choose State")}}</option>
            @if ($states)
                @foreach ($states as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $cities->state_id ? 'selected' : '' }}>{{ @$item->trans->where('locale',$current_lang)->first()->title }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

