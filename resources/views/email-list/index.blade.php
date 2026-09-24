<x-layouts::app :title="__('Email List')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-page-title> {{ __('Email List') }} </x-page-title>

        <x-card class="space-y-4">



            @if($emailLists->isNotEmpty() || filled(request('search')))

                <div class="flex justify-between pb-4">

                    <x-link-button :href="route('email-list.create')"
                        class="shadow-sm hover:-translate-y-0.5 hover:shadow-md">
                        {{ __('New List') }}
                    </x-link-button>

                    <x-form :action="route('email-list.index')" class="w-2/5">
                        <flux:input name="search" autofocus :placeholder="__('Search')" />
                    </x-form>
                </div>

                <x-table :headers="['#', __('Email List'), __('# Subscribers'), __('Actions')]">
                    <x-slot name="body" class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach ($emailLists as $list)
                            <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">

                                <x-table.td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{$list->id}}
                                </x-table.td>
                                <x-table.td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{$list->title}}
                                </x-table.td>
                                <x-table.td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{$list->subscribers_count }}
                                </x-table.td>
                                <x-table.td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <x-link-button :href="route('subscribers.index', $list)">Subscribers</x-link-button>
                                </x-table.td>


                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>

                {{  $emailLists->links()}}

            @else
                <div class="flex min-h-80 flex-col items-center justify-center rounded-xl">

                    <x-link-button :href="route('email-list.create')"
                        class="shadow-sm hover:-translate-y-0.5 hover:shadow-md">
                        {{ __('Create your first email list') }}
                    </x-link-button>
                </div>
            @endif



        </x-card>

    </div>
</x-layouts::app>