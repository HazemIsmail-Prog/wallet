<x-custom-dialog-modal wire:model="showModal">
    <x-slot name="content">
        @if (session()->has('message'))
            <p class="{{ session()->get('error-classes', 'info-classes', 'success-classes') }}">
                {{ session()->get('message') }}</p>
        @endif
        <div class="flex gap-2 mb-2">
            <input tabindex="-1" wire:model="search"
                class=" flex-1 w-full border-gray-300 dark:border-indigo-800 dark:bg-gray-800 border-r-0 border-l-0 border-t-0"
                placeholder="Search" type="text">
        </div>
        <div class="text-start bg-white dark:bg-gray-800 text-green-600 dark:text-green-400 text-xs py-3 cursor-pointer"
            wire:click="$emitTo('contact-form','showingModal',null)">
            New Contact
        </div>
        @foreach ($contacts as $contact)
            <div class=" flex ">
                <div
                    class="flex gap-2 items-center justify-between w-full cursor-pointer p-3 bg-white dark:bg-gray-800">
                    <div class="w-full" wire:click="selected({{ $contact }})">
                        <div>{{ $contact->name }}</div>
                        @if ($contact->balance < 0)
                            <div class=" font-extrabold text-red-600 dark:text-red-400">
                                {{ number_format(abs($contact->balance), session('current_country')->decimal_points) }}
                                <span
                                    class=" uppercase text-xs font-thin">{{ session('current_country')->currency }}</span>
                            </div>
                        @endif
                        @if ($contact->balance > 0)
                            <div class=" font-extrabold text-green-600 dark:text-green-400">
                                {{ number_format($contact->balance, session('current_country')->decimal_points) }} <span
                                    class=" uppercase text-xs font-thin">{{ session('current_country')->currency }}</span>
                            </div>
                        @endif
                    </div>
                    <svg wire:click="$emitTo('contact-form','showingModal',{{ $contact }})"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <svg onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $contact }})" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 text-red-600 dark:text-red-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
            </div>
        @endforeach
    </x-slot>
</x-custom-dialog-modal>
