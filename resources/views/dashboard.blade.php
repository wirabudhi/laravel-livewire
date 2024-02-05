<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <x-button onclick="Livewire.dispatch('openModal', { component: 'maps' })">Maps</x-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                {{-- @livewire('maps-view') --}}
            </div>
        </div>
    </div>
</x-app-layout>
