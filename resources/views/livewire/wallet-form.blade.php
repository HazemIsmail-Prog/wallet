<form action="" wire:submit.prevent="save">
<x-dialog-modal wire:model="showModal">
    <x-slot name="title">
        {{ $modalTitle }}
    </x-slot>
    <x-slot name="content">
            <div class=" grid grid-cols-2 gap-3">
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input wire:model="wallet.name" id="name" class="block mt-1 w-full" type="text" required
                        autofocus />
                </div>
                <div>
                    <x-label for="init_amount" value="{{ __('Initial Amount') }}" />
                    <x-input wire:model="wallet.init_amount" id="init_amount" class="block mt-1 w-full" type="number" step="{{ session('current_country')->decimal_points == 3 ? '0.001' : '0.01' }}"
                        required />
                </div>
                {{-- <div>
                    <x-label for="is_visible" value="{{ __('is_visible') }}" />
                    <x-input wire:model="wallet.is_visible" id="is_visible" class="block mt-1 w-full" type="text"
                        required />
                </div> --}}
                <div class=" col-span-2">
                    <x-label for="color" value="{{ __('Color') }}" />
                    <div x-data="{ expanded: false }">
                        <button class=" w-full h-11 rounded-lg {{ @$wallet['color'] ? 'text-white' : '' }}"
                            style="background-color: {{ @$wallet['color'] }}" type="button"
                            @click="expanded=!expanded">
                            <div>Select Color</div>
                        </button>
                        <ul x-show="expanded"
                            class=" mt-1 h-40 overflow-y-auto rounded-lg p-2 grid grid-cols-3 gap-2">
                            @foreach ($colors as $color)
                                <button @click="expanded=false" type="button" wire:click="$set('wallet.color','{{ $color }}')"
                                    class="h-10 text-white rounded-lg" style="background-color: {{ $color }};"></button>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button>Save</x-button>
        </x-slot>
    </x-dialog-modal>
    
</form>