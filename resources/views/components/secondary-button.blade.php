@props([
    'delete' => null,
])

<button {{ $attributes->class([
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
    py-2.5
    border
    bg-transparent
    hover:-translate-y-0.5
    hover:border-gray-400
    hover:bg-gray-50
    active:translate-y-0
    dark:hover:bg-transparent',
    
    'border-gray-300
    dark:border-gray-600
    dark:hover:border-gray-500
    text-gray-700
    dark:text-gray-200
    ' => !$delete,
    'border-red-300
    dark:border-red-800
    dark:hover:border-red-500
    text-red-300
    dark:text-red-800
    dark:hover:text-red-800' => $delete
])}}>

    {{ $slot }}
</button>