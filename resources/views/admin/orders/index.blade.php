<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Orders') }}</h5>
                <x-action.link href="{{ route('orders.create') }}"
                    icon="ri-add-line">{{ __('Create Order') }}</x-action.link>
            </div>
            <ul class="nav nav-pills nav-justified my-3" role="tablist">
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab"
                        aria-selected="true">
                        {{ __('All Orders') }}
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                        aria-selected="false" tabindex="-1">
                        {{ __('Pending Orders') }}
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
                        aria-selected="false" tabindex="-1">
                        {{ __('Completed Orders') }}
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-settings-1" role="tab"
                        aria-selected="false" tabindex="-1">
                        {{ __('Cancelled Orders') }}
                    </a>
                </li>
            </ul>
        </x-slot>
        <x-data-display.data-table :rows="$orders" :columnsToIgnore="['created_at', 'updated_at', 'image']" />
    </x-data-display.card>
</x-layouts.admin.master>
