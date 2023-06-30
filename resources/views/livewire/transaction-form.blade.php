    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('New Transaction') }}
        </h2>
    </x-slot>

    <div class="px-6 pt-0 pb-16 max-w-md mx-auto flex flex-col items-center gap-4">
        @livewire('category-selector')
        @livewire('contact-selector')
        @livewire('wallet-selector')
        @livewire('category-form')
        @livewire('contact-form')


        <div class="inline-flex w-full shadow-sm gap-1" role="group">
            @foreach ($transaction_types as $key => $value)
                <button type="button" wire:click="set_transaction_type('{{ $key }}')"
                    class=" 
                w-full 
                py-2 
                text-sm 
                rounded-md 
                font-medium 
                border 
                dark:border-none
                rounded-l-lg 
                text-gray-900 
                dark:text-gray-400 
                border-gray-900 
                dark:border-white 

                {{ $transaction_type == $key
                    ? '
                        ring-gray-500 
                        bg-gray-900 
                        text-white 
                        dark:text-gray-900
                        dark:bg-indigo-700 
                        '
                    : '' }}
                
                ">
                    {{ $value }}
                </button>
            @endforeach
        </div>

        <div class=" w-full flex justify-between items-center gap-3">
            <button type="button"
                class="w-full px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                <div>
                    {{ $selected_wallet->name }}

                </div>
                <div>

                    {{ $selected_wallet->formated_available_amount }}
                </div>
            </button>

            @switch($transaction_type)
                @case('expense')
                @case('loan_to')

                @case('transfer')
                    <svg class="dark:text-indigo-700 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                @break

                @case('income')
                @case('loan_from')
                    <svg class="dark:text-indigo-700 w-12 rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                @break

                @default
            @endswitch

            <button type="button" wire:click="showModal"
                class=" @error('target_id') border border-red-600 dark:border-red-400 @enderror w-full inline-flex justify-between items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                <div class=" flex-1">{{ $target_name ?? '---' }}</div>
            </button>
        </div>
        <div class=" flex flex-col items-center">
            <h1 class=" mt-6 font-extrabold text-2xl text-gray-800 dark:text-gray-400">{{ $amount ?? 0 }}
                <span class=" font-light text-sm uppercase">{{ session('current_country')->currency }}</span>
            </h1>
            <x-input-error :for="'amount'"/>
        </div>
        <x-calculator />

        <input wire:model="notes" class=" border-none dark:bg-gray-700 dark:text-gray-300 dark:placeholder:text-gray-500 w-full rounded-lg" placeholder="notes" type="text">
        <div class="flex w-full gap-4">
            <input wire:model="date" class=" border-none w-full rounded-lg dark:bg-gray-700 dark:text-gray-300" type="date">
            <input wire:model="time" class=" border-none w-full rounded-lg dark:bg-gray-700 dark:text-gray-300" type="time">
        </div>

        <button class="w-full text-white rounded-lg p-4 bg-gray-900 dark:bg-indigo-800 dark:text-gray-300" wire:click="save">Save</button>

    </div>
