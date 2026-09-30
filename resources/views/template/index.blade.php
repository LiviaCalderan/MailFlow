<x-layouts::app :title="__('MailFlow')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-page-title> {{ __('Templates') }}</x-page-title>

        <x-card class="space-y-4">

            <div class="flex justify-between pb-4">

                <x-link-button :href="route('template.create')"
                    class="shadow-sm hover:-translate-y-0.5 hover:shadow-md">
                    {{ __('New Templete') }}
                </x-link-button>

                <x-form :action="route('template.index')" class="w-3/5 flex flex-row gap-4 items-center"
                    x-data x-ref="form">
                    <flux:checkbox name="show_trash" :label="__('Show Deleted Records')"
                        :checked="request()->boolean('show_trash')" value="1" @click="$refs.form.submit()" />
                    <flux:input name="search" autofocus :placeholder="__('Search')" />

                </x-form>
            </div>

            <x-table :headers="['#', __('Name'), __('Actions')]">
                <x-slot name="body" class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($templates as $template)
                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">

                            <x-table.td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{$template->id}}
                            </x-table.td>
                            <x-table.td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                {{$template->name}}
                            </x-table.td>

                            <x-table.td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                @unless ($template->trashed())
                                <div class="flex flex-row gap-2">
                                        <x-form :action="route('template.show', $template)">
                                            <x-secondary-button type="submit">{{__('Preview')}}</x-secondary-button>
                                        </x-form>
                                        <x-form :action="route('template.edit', $template)">
                                            <x-secondary-button type="submit">{{__('Update')}}</x-secondary-button>
                                        </x-form>
                                        <x-form :action="route('template.destroy', $template)" delete
                                        onsubmit="return confirm( '{{__('Are you sure?')}}')">
                                            <x-secondary-button delete type="submit">{{__('Delete')}}</x-secondary-button>
                                        </x-form>
                                        
                                </div>
                                    
                                @else
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-line-8 text-foreground">Deleted</span>
                                
                                @endunless


                            </x-table.td>


                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            {{ $templates->links() }}

        </x-card>

    </div>
</x-layouts::app>