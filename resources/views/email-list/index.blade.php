<x-layouts::app :title="__('Email List')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex items-center justify-between border-gray-200 pb-5 dark:border-gray-700">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ __('Email List') }}
            </h2>
        </div>

        <div class="py-4 sm:py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-6 sm:p-8">

                        @forelse ($emailLists as $list)

                            //fazer lista

                        @empty
                            <div class="flex min-h-80 flex-col items-center justify-center rounded-xl">

                                <x-link-button
                                    :href="route('email-list.create')"
                                    class="shadow-sm hover:-translate-y-0.5 hover:shadow-md"
                                >
                                    {{ __('Create your first email list') }}
                                </x-link-button>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>