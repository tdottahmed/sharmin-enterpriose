<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Clients') }}</h5>
                <x-action.link href="{{ route('clients.create') }}"
                    icon="ri-add-line">{{ __('Create Client') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-display.data-table :rows="$clients" :columnsToIgnore="['created_at', 'updated_at', 'image']" />
    </x-data-display.card>
</x-layouts.admin.master>
