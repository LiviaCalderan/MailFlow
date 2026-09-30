<x-layouts::app :title="__('MailFlow')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-breadcrumb :items="[
        ['label' => 'Templates', 'url' => route('template.index')],
        ['label' => 'Preview']
    ]" />

        <x-card>
            <div class="flex justify-between mb-4 items-center">
                <div>
                    <span class="opacity-70">{{ __('Name:') }}</span> {{ $template->name }}
                </div>
                <x-link-button secondary :href="route('template.index')">{{__('Back to List')}}</x-link-button>

            </div>
            <div class="p-20 border-2 border-gray-400 rounded flex justify-center">
                {!! $template->body !!}
            </div>

        </x-card>
    </div>



</x-layouts::app>