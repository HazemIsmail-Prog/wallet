<x-custom-dialog-modal wire:model="showModal">
    <x-slot name="content">
        <div class="flex gap-2 mb-2">
            <input tabindex="-1" wire:model="search"
                class=" flex-1 w-full border-gray-300 dark:border-indigo-800 dark:bg-gray-800 border-r-0 border-l-0 border-t-0"
                placeholder="Search" type="text">
        </div>
        @foreach ($wallets as $wallet)
                <div
                    class="w-full cursor-pointer p-3 bg-white dark:bg-gray-800">
                    <div class="w-full" wire:click="selected({{ $wallet }})">
                        <div>{{ $wallet->name }}</div>
                        @if ($wallet->available_amount < 0)
                        <div class=" font-extrabold text-red-600 dark:text-red-400">
                            {{ number_format(abs($wallet->available_amount), session('current_country')->decimal_points) }}
                            <span
                                class=" uppercase text-xs font-thin">{{ session('current_country')->currency }}</span>
                        </div>
                        @endif
                        @if ($wallet->available_amount > 0)
                            <div class=" font-extrabold text-green-600 dark:text-green-400">
                                {{ number_format($wallet->available_amount, session('current_country')->decimal_points) }} <span
                                    class=" uppercase text-xs font-thin">{{ session('current_country')->currency }}</span>
                            </div>
                        @endif
                    </div>
                </div>
        @endforeach
    </x-slot>
</x-custom-dialog-modal>

