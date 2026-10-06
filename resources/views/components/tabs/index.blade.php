@props([
    'tabs' => []
])


<!-- Tab Nav -->
<div class="border-b border-gray-200 dark:border-neutral-700 mb-6">
    <nav id="hs-tabs" class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
        @foreach ($tabs as $title => $route)
            @php
                $isActive = request()->getUri() === $route || request()->getUri() === url($route);
            @endphp

            <a href="{{ $route }}" aria-current="{{ $isActive ? 'page' : 'false' }}" class="
                                relative
                                py-4 px-1
                                inline-flex items-center gap-x-2
                                text-sm whitespace-nowrap
                                after:absolute after:-bottom-px
                                after:inset-x-0 after:w-full after:h-0.5
                                transition-colors

                                {{ $isActive
            ? 'font-semibold text-gray-900 dark:text-neutral-300 after:bg-gray-900 dark:after:bg-neutral-300'
            : 'text-gray-500 dark:text-neutral-400 after:bg-transparent hover:text-gray-900 dark:hover:text-neutral-300'
                                }}

                                focus:outline-hidden
                                focus:text-gray-900
                                dark:focus:text-neutral-300
                            ">
                {{ $title }}
            </a>
        @endforeach


    </nav>
</div>
<!-- End Tab Nav -->

{{ $slot }}