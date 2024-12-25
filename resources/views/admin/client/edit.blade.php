<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Edit Client') }}</h5>
                <x-action.link href="{{ route('clients.index') }}"
                    icon="ri-list-check">{{ __('Client List') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-entry.form action="{{ route('clients.update', $client->id) }}" model="{{ $client }}">
            <x-data-entry.input type="text" name="name" label="Name" placeholder="Name" required
                value="{{ $client->name }}" />
            <x-data-entry.input type="tel" name="number" label="Phone Number" placeholder="Phone Number" required
                value="{{ $client->number }}" />
            <x-data-entry.input type="email" name="email" label="Email" placeholder="Email" required
                value="{{ $client->email }}" />
            <x-data-entry.text-area name="address" label="Address" placeholder="Address" required
                value="{{ $client->address }}" />
            <x-data-entry.text-area name="work_details" label="Work Details" placeholder="Work Details" required
                value="{{ $client->work_details }}" />
            <img class="img-fluid" src="{{ getFilePath($client->image) }}" alt="{{ $client->name }}" height="200">
            <x-data-entry.input type="file" name="image" label="Image" />
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
