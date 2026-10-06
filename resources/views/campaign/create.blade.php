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
                <x-form :action="route('campaigns.create', compact('tab'))" post>

                @include('campaign.create.'. $form)


                </x-form>
            </x-tabs>
           
        </x-card>

    </div>
</x-layouts::app>