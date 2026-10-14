@php
    $selectedEmailList = (string) old(
        'email_list_id',
        $data['email_list_id'] ?? ''
    );

    $selectedTemplate = (string) old(
        'template_id',
        $data['template_id'] ?? ''
    );

    $trackClick = filter_var(
        old('track_click', $data['track_click'] ?? false),
        FILTER_VALIDATE_BOOLEAN
    );

    $trackOpen = filter_var(
        old('track_open', $data['track_open'] ?? false),
        FILTER_VALIDATE_BOOLEAN
    );
@endphp

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mb-8">

    <flux:input name="name" :label="__('Name')" :value="old('name', $data['name'])" required autofocus
        placeholder="Subscriber Name" />


    <flux:input name="subject" :label="__('Subject')" :value="old('subject', $data['subject'])" required autofocus
        placeholder="Campaign Subject" />


    <flux:select name="email_list_id" :label="__('Email List')" required autofocus placeholder="Choose an Email List">
        @foreach ($emailLists as $list)
            @if ($selectedEmailList === (string) $list->id)
                <flux:select.option value="{{ $list->id }}" selected>
                    {{ $list->title }}
                </flux:select.option>
            @else
                <flux:select.option value="{{ $list->id }}">
                    {{ $list->title }}
                </flux:select.option>
            @endif
        @endforeach
    </flux:select>

    <flux:select name="template_id" :label="__('Template')" required autofocus placeholder="Choose a Template">
        @foreach ($template as $list)
            @if ($selectedTemplate === (string) $list->id)
                <flux:select.option value="{{ $list->id }}" selected>
                    {{ $list->name }}
                </flux:select.option>
            @else
                <flux:select.option value="{{ $list->id }}">
                    {{ $list->name }}
                </flux:select.option>
            @endif
        @endforeach
    </flux:select>

    <div class="flex flex-col gap-2">
        <flux:field variant="inline">
            <flux:checkbox name="track_click" :label="__('Track Click')" autofocus :checked="$trackClick" value="1" />
            <flux:error name="terms" />
        </flux:field>

        <flux:field variant="inline">
            <flux:checkbox name="track_open" :label="__('Track Open')" autofocus :checked="$trackOpen" value="1" />
            <flux:error name="terms" />
        </flux:field>

    </div>


</div>

<div class="flex items-center space-x-4">
    <x-link-button secondary :href="route('campaigns.index')">
        {{ __('Cancel') }}
    </x-link-button>
    <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
</div>