<x-layouts::app :title="__('Compaigns')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-breadcrumb :items="[
        ['label' => __('Campaigns'), 'url' => route('campaigns.index')],
        ['label' => __('New Campaign')]
    ]" />

        <x-card>
            <x-tabs :tabs="[
            __('Configuration') => route('campaigns.create'),
            __('Template') => route('campaigns.create', ['tab' => 'template']),
            __('Schedule') => route('campaigns.create', ['tab' => 'schedule']),
        ]">
                <x-form :action="route('campaigns.create')" post>

                    <!-- Tab Content -->
                    <div class="mt-3">
                        <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                            <p class="text-gray-500 dark:text-neutral-400">
                                This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">first</em>
                                item's
                                tab body.
                            </p>
                        </div>
                        <div id="tabs-with-underline-2" class="hidden" role="tabpanel"
                            aria-labelledby="tabs-with-underline-item-2">
                            <p class="text-gray-500 dark:text-neutral-400">
                                This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">second</em>
                                item's
                                tab body.
                            </p>
                        </div>
                        <div id="tabs-with-underline-3" class="hidden" role="tabpanel"
                            aria-labelledby="tabs-with-underline-item-3">
                            <p class="text-gray-500 dark:text-neutral-400">
                                This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">third</em>
                                item's
                                tab body.
                            </p>
                        </div>
                    </div>
                    <!-- End Tab Content -->

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                        <flux:input name="name" :label="__('Name')" :value="old('name')" required autofocus
                            placeholder="Subscriber Name" />


                        <flux:input name="subject" :label="__('Subject')" :value="old('subject')" required autofocus
                            placeholder="Campaign Subject" />

                        <flux:input name="email_list_id" :label="__('Email List')" :value="old('email_list_id')"
                            required autofocus placeholder="Choose an Email List" />

                        <flux:input name="template_id" :label="__('Template')" :value="old('template_id')" required
                            autofocus placeholder="Choose a Template" />



                        <div class="flex items-center space-x-4">
                            <x-link-button secondary :href="route('campaigns.index')">
                                {{ __('Cancel') }}
                            </x-link-button>
                            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                        </div>
                    </div>




                </x-form>
            </x-tabs>
           
        </x-card>

    </div>
</x-layouts::app>