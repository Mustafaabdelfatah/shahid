<div>
    <div class="col-lg-12">
        <label for="select2Multiple" class="form-label">{{ __('Package') }}</label>
        <select class="form-control w-100" id="select2Multiple" wire:model.live="selectPackage" name="package_id">
            <option selected>{{ __('Choose Package') }}</option>
            @foreach ($packages as $item)
                <option value="{{ $item->id }}">{{ $item->trans->where('locale', $current_lang)->first()->title }}
                </option>
            @endforeach
        </select>
        @error('package_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-12 mt-2">
        <label for="select2Multiple" class="form-label">{{ __('Data Package') }}</label>
        <select class="form-control w-100" id="select2Multiple" name="date_package_id">
            <option disabled selected>{{ __('Choose Data ') }}</option>
            @if ($data_packages)
                @foreach ($data_packages as $item)
                    <option value="{{ $item->id }}"> {{ __('Price is : ') }}${{ @$item->price }} &
                        {{ __(' Day is : ') }} {{ $item->duration }}</option>
                @endforeach
            @endif
        </select>
        @error('date_package_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
