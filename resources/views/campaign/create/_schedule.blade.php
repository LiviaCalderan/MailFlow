<div class="grid gap-6">

    <flux:input type="date" name="send_at" :label="__('Send At')" :value="old('send_at', $data['send_at'])" required autofocus placeholder="Subscriber Name" />



    <div class="flex items-center space-x-4">
        <x-link-button secondary :href="route('campaigns.index')">
            {{ __('Cancel') }}
        </x-link-button>
        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
    </div>
</div>