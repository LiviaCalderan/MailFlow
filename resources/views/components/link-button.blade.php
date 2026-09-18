@props([
    'href',
])

<a href="{{ $href }}" {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
            inline-flex
            items-center
            justify-center
            gap-2
            rounded-lg
            bg-gray-900
            px-4
            py-2.5
            text-sm
            font-semibold
            text-white
            shadow-sm
            transition-all
            duration-200
            hover:bg-gray-800
            hover:shadow-md
            focus:outline-none
            focus:ring-2
            focus:ring-gray-400
            focus:ring-offset-2
            active:scale-[0.98]
            dark:bg-white
            dark:text-gray-900
            dark:hover:bg-gray-100
            dark:focus:ring-gray-500
            dark:focus:ring-offset-gray-900
        '
]) }}>

    {{ $slot }}
</a>