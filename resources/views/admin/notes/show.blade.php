<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ $note->title }}</h5>
                <x-action.link href="{{ route('notes.index') }}"
                    icon="ri-list-check">{{ __('Note List') }}</x-action.link>
            </div>
        </x-slot>
        {!! $note->description !!}
    </x-data-display.card>
</x-layouts.admin.master>
