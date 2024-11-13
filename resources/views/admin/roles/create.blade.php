<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <h5 class="card-title">Roles List</h5>
        </x-slot>
        <x-data-entry.form action="{{ route('roles.store') }}" method="POST">
            <x-data-entry.input type="text" name="name" label="Role Name" placeholder="Role Name" required />
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
