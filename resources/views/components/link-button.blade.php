@props([
    'href',
    'secondary' => null,
])

<a href="{{ $href }}" {{ $attributes->class([
    'inline-flex
    items-center
    justify-center
    gap-2
    text-sm
    font-semibold
    rounded-lg
    shadow-sm
    hover:shadow-md
    transition-all
    duration-200
    active:scale-[0.98]
    focus:ring-2
    dark:focus:ring-gray-500
    dark:focus:ring-offset-gray-900
    focus:outline-none
    focus:ring-gray-400
    focus:ring-offset-2
    px-4
    py-2.5',

    '
    bg-gray-900
    text-white
    hover:bg-gray-800
    dark:bg-white
    dark:text-gray-900
    dark:hover:bg-gray-100
    ' => !$secondary,

    '
    border
    border-gray-300
    bg-transparent
    text-gray-700
    hover:-translate-y-0.5
    hover:border-gray-400
    hover:bg-gray-50
    active:translate-y-0
    dark:border-gray-600
    dark:text-gray-200
    dark:hover:border-gray-500
    dark:hover:bg-gray-800
    ' => $secondary

]) }}>

    {{ $slot }}
</a>