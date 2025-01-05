<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Notes') }}</h5>
                <x-action.link href="{{ route('notes.create') }}"
                    icon="ri-add-line">{{ __('Create Note') }}</x-action.link>
            </div>
        </x-slot>
        <div class="d-flex flex-wrap justify-content-start gap-3">
            @forelse ($notes as $note)
                <div class="mb-4" style="flex: 1 1 calc(33.333% - 1rem); min-width: 280px;">
                    <x-data-display.card>
                        <x-slot name="header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">{{ $note->title }}</h6>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('notes.edit', $note->id) }}" class="link-success fs-16">
                                        <i class="ri-edit-2-line"></i>
                                    </a>
                                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="link-danger fs-16">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                        <p class="card-text">{!! str($note->description)->limit(350) !!}</p>
                        <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-primary">
                            {{ __('Read More') }} <i class="ri-arrow-right-line"></i>
                        </a>
                    </x-data-display.card>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        {{ __('No notes available.') }}
                    </div>
                </div>
            @endforelse
        </div>
    </x-data-display.card>
    @push('scripts')
        <script>
            document.querySelectorAll('.link-danger').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        customClass: {
                            confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                            cancelButton: 'btn btn-danger w-xs mt-2',
                        },
                        confirmButtonText: 'Yes, delete it!',
                        buttonsStyling: false,
                        showCloseButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.admin.master>
