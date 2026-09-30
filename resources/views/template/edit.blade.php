<x-layouts::app :title="__('MailFlow')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-breadcrumb :items="[
        ['label' => 'Templates', 'url' => route('template.index')],
        ['label' => 'Update Template']]" />

        <x-card>
            <x-form :action="route('template.update', $template)" put>

                <div class="flex flex-col space-y-4">

                    <flux:input name="name" :label="__('Name')" :value="old('name', $template->name)" required autofocus
                        placeholder="Template Name" />

                    <x-richtext name="body" :label="__('Body')" :value="old('body', $template->body)" wire:model="body"/>


                    <div class="flex items-center space-x-4">
                        <x-link-button secondary :href="route('template.index')">
                            {{ __('Cancel') }}
                        </x-link-button>
                        <x-primary-button type="submit">{{ __('Update') }}</x-primary-button>
                    </div>
                </div>


            </x-form>

        </x-card>
    </div>



</x-layouts::app>
