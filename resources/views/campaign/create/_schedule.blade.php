<div class="grid gap-6">

    <flux:input type="date" name="sent_at" :label="__('Send At')" :value="old('sent_at', $data['sent_at'])" required autofocus placeholder="Subscriber Name" />



    <div class="flex items-center space-x-4">
        <x-link-button secondary :href="route('campaigns.index')">
            {{ __('Cancel') }}
        </x-link-button>
        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
    </div>
</div>