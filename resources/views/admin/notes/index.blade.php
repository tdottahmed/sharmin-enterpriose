<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Notes') }}</h5>
                <x-action.link href="{{ route('notes.create') }}"
                    icon="ri-add-line">{{ __('Create Note') }}</x-action.link>
            </div>
        </x-slot>
        <div class="row">
            @forelse ($notes as $note)
                <div class="col-lg-4">
                    <x-data-display.card>
                        <x-slot name="header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title">{{ $note->title }}</h6>
                                <div class="hstack gap-3 d-flex">
                                    <a href="{{ route('notes.edit', $note->id) }}" class="link-success fs-15"><i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="{{ route('notes.destroy', $note->id) }}" class="link-danger fs-15"><i
                                            class="ri-delete-bin-line"></i></a>
                                </div>
                            </div>
                        </x-slot>
                        <p>{!! str($note->description)->limit(350) !!}</p>
                        <a href="{{ route('notes.show', $note->id) }}"
                            class="btn btn-sm btn-primary">{{ __('Read More') }}"></a>
                    </x-data-display.card>
                </div>
            @empty
            @endforelse
        </div>
    </x-data-display.card>
</x-layouts.admin.master>
