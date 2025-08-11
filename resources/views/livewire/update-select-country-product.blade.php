<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <label for="select2Multiple" class="form-label">{{ __('Country') }}<span
                        class="text-danger">*</span></label>
                    <select class="form-control w-100" id="select2Multiple"
                    wire:model.live="selectCountry" name="country_id">
                    <option >{{__("Choose Country")}}</option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}" {{  $item->id == $product->country_id ? 'selected' : '' }}>{{ $item->trans->where('locale',$current_lang)->first()->title }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                <div class="col-md-6">
                    <label for="select2Multiple" class="form-label">{{ __('States') }}<span
                        class="text-danger">*</span></label>
                    <select class="form-control w-100" id="select2Multiple" wire:model.live="selectState"
                    name="state_id" >
                        <option >{{__("Choose State")}}</option>
                        @if ($states)
                            @foreach ($states as $item)
                                <option value="{{ $item->id }}" {{  $item->id == $product->state_id ? 'selected' : '' }}>{{ @$item->trans->where('locale',$current_lang)->first()->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('state_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label for="select2Multiple" class="form-label">{{ __('City') }}<span
                        class="text-danger">*</span></label>
                    <select class="form-control w-100" id="select2Multiple"
                    name="city_id"  wire:model.live="selectCity">
                        <option >{{__("Choose City")}}</option>
                        @if ($cities)
                            @foreach ($cities as $item)
                                <option value="{{ $item->id }}" {{  $item->id == $product->city_id ? 'selected' : '' }}>{{ @$item->trans->where('locale',$current_lang)->first()->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('city_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label for="select2Multiple" class="form-label">{{ __('District') }}<span
                        class="text-danger">*</span></label>
                    <select class="form-control w-100" id="select2Multiple"
                    name="district_id">
                        <option >{{__("Choose District")}}</option>
                        @if (@$districts)
                            @foreach ($districts as $item)
                                <option value="{{ $item->id }}" {{  $item->id == $product->district_id ? 'selected' : '' }}>{{ @$item->trans->where('locale',$current_lang)->first()->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('district_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>
            </div>

        </div>
    </div>

    </div>

