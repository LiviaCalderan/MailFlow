<button {{ $attributes }} class="inline-flex
            items-center
            justify-center
            gap-2
            rounded-lg
            border
            border-gray-300
            bg-transparent
            px-4
            py-2.5
            text-sm
            font-semibold
            text-gray-700
            shadow-sm
            transition-all
            duration-200
            hover:-translate-y-0.5
            hover:border-gray-400
            hover:bg-gray-50
            hover:shadow-md
            focus:outline-none
            focus:ring-2
            focus:ring-gray-400
            focus:ring-offset-2
            active:translate-y-0
            active:scale-[0.98]
            dark:border-gray-600
            dark:text-gray-200
            dark:hover:border-gray-500
            dark:hover:bg-gray-800
            dark:focus:ring-gray-500
            dark:focus:ring-offset-gray-900">

    {{ $slot }}
</button>