<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="pb-16">
        <div class="max-w-md mx-auto">
            <div class="w-full flex flex-col p-4">
                @if (session()->has('message'))
                    <p class="{{ session()->get('error-classes', 'info-classes', 'success-classes') }}">
                        {{ session()->get('message') }}</p>
                @endif
                <a href="{{ route('countries.index') }}" class="flex gap-4 rounded-lg p-4 shadow dark:shadow-none bg-white text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                    <div class="flex-1">Countries</div>
                    <div>
                        <span
                            class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ auth()->user()->countries->count() }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>

                    </div>
                </a>


            </div>
        </div>
    </div>
</x-app-layout>
