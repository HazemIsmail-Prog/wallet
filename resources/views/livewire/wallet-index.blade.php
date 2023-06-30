    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Wallets') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto p-6 pb-16 flex flex-col gap-3">
        @livewire('wallet-form')
        @if (session()->has('message'))
            <p class="{{ session()->get('error-classes', 'info-classes','success-classes') }}">{{ session()->get('message') }}</p>
        @endif
        <div class="flex gap-3 text-gray-800 dark:text-gray-400">
            @if ($wallets)
                <div class="flex-1">
                    <h1 class=" font-extralight text-sm">Total Available</h1>
                    <h1 class="text-start text-3xl font-extrabold">
                        {{ number_format($wallets->sum('available_amount'), session('current_country')->decimal_points) }}
                        <span class=" font-light text-xs uppercase">{{ session('current_country')->currency }}</span>
                    </h1>
                </div>
            @endif
            <button wire:click="$emitTo('wallet-form','showingModal',null)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>

            @if ($wallets->count() > 0)
                <button wire:click="$toggle('showEdit')">
                    @if (!$showEdit)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    @endif

                </button>
            @endif
        </div>
        @foreach ($wallets as $wallet)
            <div class=" flex items-center gap-4">
                <a href="{{ route('transaction.form', $wallet) }}" style="background-color: {{ $wallet->color }}"
                    class="flex flex-1 justify-between items-center bg-gradient-to-bl from-gray-700/50 to-transparent  rounded-xl p-8 h-36 dark:shadow-none shadow-md shadow-gray-500 text-white">
                    <div>{{ $wallet->name }}</div>
                    <div class="font-normal text-xs">
                        <div class=" text-right">Available Amount</div>
                        <div class=" text-2xl font-extrabold">{{ $wallet->formated_available_amount }} <span
                                class="font-normal text-xs uppercase">{{ $wallet->country->currency }}</span></div>
                    </div>
                </a>
                @if ($showEdit)
                    <svg wire:click="$emitTo('wallet-form','showingModal',{{ $wallet }})"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-indigo-600 dark:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <svg onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $wallet }})" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 text-red-600 dark:text-red-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                @endif
            </div>
        @endforeach

    </div>
