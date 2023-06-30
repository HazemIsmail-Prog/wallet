<form action="" wire:submit.prevent="save">
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ $modalTitle }}
        </x-slot>
        <x-slot name="content">

            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.defer="category.name" id="name" class="block mt-1 w-full" type="text" required
                autofocus />

        </x-slot>
        <x-slot name="footer">
            <x-button>Save</x-button>
        </x-slot>
    </x-dialog-modal>

</form>
