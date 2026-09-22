<x-layouts::app :title="__('Email List')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <x-page-title>{{ __('Email List') }} > {{ __('Create New List') }} </x-page-title>

        <x-card>
            <x-form :action="route('email-list.store')" post enctype="multipart/form-data">

                <div class="flex flex-col space-y-4">

                    <flux:input name="title" :label="__('Title')" :value="old('title')" required autofocus
                        placeholder="List Title" />

                    <flux:input name="file" :label="__('File List')" type="file" accept=".csv" required autofocus />



                    <div class="flex items-center space-x-4">
                        <x-secondary-button type="reset">{{ __('Reset') }}</x-secondary-button>
                        <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                    </div>
                </div>


            </x-form>

        </x-card>
    </div>



</x-layouts::app>