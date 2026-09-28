@props(['items' => []])

<ol class="flex items-center justify-center">
    @foreach ($items as $index => $item)
        @php
            $isLast = $index === count($items) - 1;
        @endphp

        <li class="justify-center">
            @if (!$isLast)
                <a
                    href="{{ $item['url'] ?? '#' }}"
                    class="flex items-center text-2xl text-gray-500 dark:text-neutral-400 hover:text-gray-900 dark:hover:text-neutral-300 focus:outline-hidden focus:text-gray-900 dark:focus:text-neutral-300"
                >
                    {{ $item['label'] }}

                    <svg
                        class="shrink-0 mx-2 size-4 text-gray-400 dark:text-neutral-500"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            @else
                <span
                    class="inline-flex items-center text-2xl font-semibold text-gray-800 dark:text-neutral-200 truncate"
                    aria-current="page"
                >
                    {{ $item['label'] }}
                </span>
            @endif
        </li>
    @endforeach
</ol>