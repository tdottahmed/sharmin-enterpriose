<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Create Client') }}</h5>
                <x-action.link href="{{ route('clients.index') }}"
                    icon="ri-list-check">{{ __('Client List') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-entry.form action="{{ route('clients.store') }}">
            <x-data-entry.select name="client_id" label="Client Name" placeholder="Client Name" :options="$clients"
                :selected="old('client_id')" label="Select Client" required />
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
