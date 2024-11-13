<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Roles</h5>
                <x-action.link href="{{ route('roles.create') }}" icon="ri-add-line">Create</x-action.link>
            </div>
        </x-slot>
        {{-- <x-data-display.data-table :data="$roles" />         --}}
    </x-data-display.card>
</x-layouts.admin.master>
