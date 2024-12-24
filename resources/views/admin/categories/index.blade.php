<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Categories</h5>
                <x-action.link href="{{ route('categories.create') }}"
                    icon="ri-add-line">{{ __('Create Category') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-display.data-table :rows="$rows" :ignoreActions="['show']" />
    </x-data-display.card>
</x-layouts.admin.master>
