<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Permissions</h5>
                <x-action.link href="{{ route('permissions.create') }}"
                    icon="ri-add-line">{{ __('Create Permission') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-display.data-table :rows="$permissions" :ignoreActions="['show']" />
    </x-data-display.card>
</x-layouts.admin.master>
