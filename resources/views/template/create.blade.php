<x-layouts::app :title="__('MailFlow')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-breadcrumb :items="[
        ['label' => 'Templates', 'url' => route('template.index')],
        ['label' => 'Create Template']
    ]" />

        <x-card>
            <x-form :action="route('template.store')" post>

                <div class="flex flex-col space-y-4">

                    <flux:input name="name" :label="__('Name')" :value="old('name')" required autofocus
                        placeholder="Template Name" />

                    {{-- <flux:textarea name="body" :label="__('Body')" :value="old('body')" required autofocus
                        placeholder="Email Body" /> --}}

                    <x-richtext name="body" :label="__('Body')" :value="old('body')" wire:model="body"
                        placeholder="Email Body"/>


                    <div class="flex items-center space-x-4">
                        <x-link-button secondary :href="route('template.index')">
                            {{ __('Cancel') }}
                        </x-link-button>
                        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                    </div>
                </div>


            </x-form>

        </x-card>
    </div>



</x-layouts::app>