<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-16">
        <div class="max-w-md mx-auto">
            <div class="flex flex-col p-4 gap-4">
                @livewire('expenses-report')
            </div>
        </div>
    </div>
</x-app-layout>
