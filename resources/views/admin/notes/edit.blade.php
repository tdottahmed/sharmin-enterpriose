<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Edit Note') }}</h5>
                <x-action.link href="{{ route('notes.index') }}" icon="ri-add-line">{{ __('Note List') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-entry.form action="{{ route('notes.update', $note->id) }}" model="{{ $note }}') }}">
            <x-data-entry.input type="text" name="title" label="Title" placeholder="Title"
                value="{{ $note->title }}" required />
            <x-data-entry.editor name="description">{{ $note->description }}</x-data-entry.editor>
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
