<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Create Note') }}</h5>
                <x-action.link href="{{ route('notes.index') }}" icon="ri-list-check">
                    {{ __('Note List') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-entry.form action="{{ route('notes.store') }}">
            <x-data-entry.input type="text" name="title" label="Title" placeholder="Title" required />
            <x-data-entry.editor name="description" />
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
