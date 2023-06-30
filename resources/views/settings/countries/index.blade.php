<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Countries') }}
        </h2>
    </x-slot>

    <div class="pb-16">
        <div class="max-w-md mx-auto p-4">
            <div class=" flex items-center justify-between mb-4">
                <a href="{{ route('settings') }}"
                    class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Back</a>
                <a href="{{ route('countries.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">New
                    Country</a>
            </div>
            <div class="w-full flex flex-col gap-3">
                @foreach ($countries as $country)
                    <a href="{{ route('countries.edit', $country) }}"
                        class="flex gap-4 rounded-lg p-4 shadow dark:shadow-none bg-white text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                        <div class="flex-1">{{ $country->name }}</div>
                        <div>{{ number_format($country->wallets->sum('available_amount'), $country->decimal_points) }}
                            <span class=" uppercase text-xs">{{ $country->currency }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
