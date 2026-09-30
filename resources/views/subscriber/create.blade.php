<x-layouts::app :title="__('Email List')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
         <x-breadcrumb :items="[
        ['label' => __('Email List'), 'url' => route('email-list.index')],
        ['label' =>  $emailList->title, 'url' => route('subscribers.index', $emailList)],
        ['label' => __('Add New Subscribers')]
    ]" />

        <x-card>
            <x-form :action="route('subscribers.create', $emailList)" post>

                <div class="flex flex-col space-y-4">

                    <flux:input name="name" :label="__('Name')" :value="old('name')" required autofocus
                        placeholder="Subscriber Name" />

                    <flux:input name="email" :label="__('Email')" :value="old('email')" required autofocus
                        placeholder="subscriber@example.com" />



                    <div class="flex items-center space-x-4">
                        <x-link-button secondary :href="route('subscribers.index', $emailList)">
                            {{ __('Cancel') }}
                        </x-link-button>
                        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                    </div>
                </div>


            </x-form>

        </x-card>
    </div>



</x-layouts::app>