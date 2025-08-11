<div>
    @include('layouts.admin.message')
    <div class="row row-cols-sm-2 row-cols-1">
        <div class="mb-3">
            <label class="form-label" for="FullName">{{ __('Name') }}</label>
            <input type="text" wire:model="name" id="FullName" class="form-control">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="Email">{{ __('Email') }}</label>
            <input type="email" wire:model="email" id="Email" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="web-url">{{ __('Phone') }}</label>
            <input type="text" wire:model="phone" placeholder="Phone" id="web-url" class="form-control">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="Username">{{ __('Positions') }}</label>
            <input type="text" wire:model="positions" id="Username" class="form-control">
            @error('positions')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="Country">{{ __('Country') }}</label>
            <input type="text" wire:model="country" id="Country" class="form-control">
            @error('country')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="city">{{ __('City') }}</label>
            <input type="text" wire:model="city" id="city" class="form-control">
            @error('city')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="cover_image">{{ __('Cover Image') }}</label>
            <input type="file" id="cover_image" wire:model="cover_image" class="form-control">
            @error('cover_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            {{-- @if ($cover_image)
                Photo Preview:
                <img src="{{ @$cover_image->temporaryUrl() }}">
            @endif --}}
        </div>
        <div class="mb-3">
            <label class="form-label" for="Image">{{ __('Image') }}</label>
            <input type="file" id="Image" class="form-control" wire:model="image">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @if ($image)
                Photo Preview:
                <img src="{{ $image->temporaryUrl() }}">
            @endif
        </div>
        <div class="col-sm-12 mb-3">
            <label class="form-label" for="AboutMe">{{ __('Bio') }}</label>
            <textarea style="height: 125px;" id="AboutMe" class="form-control" wire:model="bio"></textarea>
            @error('bio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <button class="btn btn-success" type="button" wire:click="update">
        <i class="ri-save-line me-1 fs-16 lh-1"></i>{{ __('Edit') }}
    </button>

</div>
