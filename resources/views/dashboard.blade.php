<x-layouts.admin.master>
    <div class="row">
        <div class="col-lg-6">
            <h3>Buttons</h3>
            <hr>
            <x-action.button variant="primary">Primary</x-action.button>
            <x-action.button variant="danger" icon="ri-close-line">Danger</x-action.button>
            <x-action.button variant="warning" icon="ri-information-line">Warning</x-action.button>
            <x-action.button variant="info" icon="ri-information-line">Info</x-action.button>
            <x-action.button variant="secondary" icon="ri-arrow-right-fill">Secondary</x-action.button>
        </div>
        <div class="col-lg-6">
            <h3>Inputs</h3>
            <hr>
            <x-data-entry.input type="email" name="email" label="Email" placeholder="Email" required />
            <x-data-entry.input type="password" name="password" label="password" placeholder="Email" required />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>card</h3>
            <hr>
            <x-data-display.card>
                <x-slot name="header">
                    <h5 class="card-title">Special title treatment</h5>
                </x-slot>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary w-100">Go somewhere</a>
                <x-slot name="footer">
                    footer text
                </x-slot>
            </x-data-display.card>
        </div>
        <div class="col-lg-6">
            <h3>Data Table</h3>
            <hr>
            <x-data-display.card>
                <x-slot name="header">
                    <h5 class="card-title">Special title treatment</h5>
                </x-slot>
                <x-slot name="footer">
                    footer text
                </x-slot>
            </x-data-display.card>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Alert</h3>
            <hr>
            <x-data-display.sweet-alert />
        </div>
        <div class="col-lg-6">
            <h3>Select 2</h3>
            <hr>
            {{-- <x-data-entry.select /> --}}
        </div>
    </div>
    <x-data-entry.uploader-dropzone />
    <x-data-entry.date-picker name="date" />
</x-layouts.admin.master>
