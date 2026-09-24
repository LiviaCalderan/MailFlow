@props([
    'headers',
    'body'
])

<div class="min-w-full">
    <div
        class="border border-table-line rounded-lg shadow-xs overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead>
                @foreach ($headers as $header)
                    <th scope="col"
                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase">
                        {{ $header }}
                    </th>
                @endforeach

            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>
<!-- End Table -->