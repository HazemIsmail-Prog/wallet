<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Country') }}
        </h2>
    </x-slot>

    <div class="pb-16">
        <div class="max-w-md mx-auto p-4">
            <form action="{{ route('countries.update',$country) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col space-y-2">

                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$country->name)"
                            required autofocus />
                    </div>
                    <div>
                        <x-label for="currency" value="{{ __('Currency') }}" />
                        <x-input id="currency" class="block mt-1 w-full" type="text" name="currency"
                            :value="old('currency',$country->currency)" required />
                    </div>
                    <div>
                        <x-label for="decimal_points" value="{{ __('Decimal Points') }}" />
                        <x-input id="decimal_points" class="block mt-1 w-full" type="number" name="decimal_points"
                            :value="old('decimal_points',$country->decimal_points)" required />
                    </div>
                </div>
                <div class=" text-end">
                    <a href="{{ route('countries.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>
                    <x-button class="mt-4">Save</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
