
<div class="flex flex-col gap-4">

    <x-richtext name="body" :label="__('Email Body')" :value="old('body', $data['body'])" wire:model="body"/>

    <div class="flex items-center space-x-4">
        <x-link-button secondary :href="route('campaigns.index')">
            {{ __('Cancel') }}
        </x-link-button>
        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
    </div>
</div>