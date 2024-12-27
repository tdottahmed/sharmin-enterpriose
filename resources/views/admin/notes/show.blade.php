<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ $note->title }}</h5>
                <div class="d-flex gap-2">
                    <x-action.link href="{{ route('notes.index') }}"
                        icon="ri-list-check">{{ __('Note List') }}</x-action.link>
                    <x-action.link variant="secondary" href="{{ route('notes.edit', $note->id) }}" class="ms-2"
                        icon="ri-edit-line">{{ __('Edit') }}
                    </x-action.link>
                </div>
            </div>
        </x-slot>
        {!! $note->description !!}
    </x-data-display.card>
</x-layouts.admin.master>
