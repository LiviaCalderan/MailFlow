<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

    <flux:input name="name" :label="__('Name')" :value="old('name', $data['name'])" required autofocus
        placeholder="Subscriber Name" />


    <flux:input name="subject" :label="__('Subject')" :value="old('subject', $data['subject'])" required autofocus
        placeholder="Campaign Subject" />

    <flux:input name="email_list_id" :label="__('Email List')" :value="old('email_list_id', $data['email_list_id'])"
        required autofocus placeholder="Choose an Email List" />

    <flux:input name="template_id" :label="__('Template')" :value="old('template_id', $data['template_id'])" required
        autofocus placeholder="Choose a Template" />

    <div>
        <flux:input name="track_click" :label="__('Track Click')" :value="old('track_click', $data['track_click'])"
            autofocus placeholder="Choose a Template" />
    </div>

    <div>
        <flux:input name="track_open" :label="__('Track Open')" :value="old('track_open', $data['track_open'])"
            autofocus placeholder="Choose a Template" />
    </div>

    {{-- <flux:field variant="inline">
        <flux:checkbox wire:model="terms" />

        <flux:label>I agree to the terms and conditions</flux:label>

        <flux:error name="terms" />
    </flux:field> --}}


    <div class="flex items-center space-x-4">
        <x-link-button secondary :href="route('campaigns.index')">
            {{ __('Cancel') }}
        </x-link-button>
        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
    </div>
</div>