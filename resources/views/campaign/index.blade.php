<x-layouts::app :title="__('Compaigns')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-breadcrumb :items="[
         ['label' =>  __('Campaigns')]]" />

        <x-card class="space-y-4">

            <div class="flex justify-between pb-4">

                <x-link-button :href="route('campaigns.create')"
                    class="shadow-sm hover:-translate-y-0.5 hover:shadow-md">
                    {{ __('New Campaign') }}
                </x-link-button>

                <x-form :action="route('campaigns.index')" class="w-3/5 flex flex-row gap-4 items-center" x-data
                    x-ref="form">
                    <flux:checkbox name="show_trash" :label="__('Show Deleted Records')"
                        :checked="request()->boolean('show_trash')" value="1" @click="$refs.form.submit()" />
                    <flux:input name="search" autofocus :placeholder="__('Search')" />

                </x-form>
            </div>

            <x-table :headers="['#', __('Name'), __('Actions')]">
                <x-slot name="body" class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($campaigns as $campaign)
                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">

                            <x-table.td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{$campaign->id}}
                            </x-table.td>
                            <x-table.td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                {{$campaign->name}}
                            </x-table.td>

                            <x-table.td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                @unless ($campaign->trashed())
                                    <div class="flex flex-row gap-2">
                                        <x-form :action="route('campaigns.index')">
                                            <x-secondary-button type="submit">{{__('Preview')}}</x-secondary-button>
                                        </x-form>
                                        <x-form :action="route('campaigns.destroy', $campaign)" delete
                                            onsubmit="return confirm( '{{__('Are you sure?')}}')">
                                            <x-secondary-button delete type="submit">{{__('Delete')}}</x-secondary-button>
                                        </x-form>

                                    </div>

                                @else
                                    <div class="flex flex-row gap-2">
                                        <x-form :action="route('campaigns.restore', $campaign)" patch
                                            onsubmit="return confirm( '{{__('Restore this campaign?')}}')">
                                            <x-secondary-button delete type="submit">{{__('Restore')}}</x-secondary-button>
                                        </x-form>
                                    </div>


                                @endunless


                            </x-table.td>


                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            {{ $campaigns->links() }}

        </x-card>

    </div>
</x-layouts::app>