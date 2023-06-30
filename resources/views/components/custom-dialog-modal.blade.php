@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="p-4">
        <div class=" text-sm text-gray-600 dark:text-gray-400">
            {{ $content }}
        </div>
    </div>
</x-modal>
