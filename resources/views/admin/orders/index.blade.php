<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Orders') }}</h5>
                <x-action.link href="{{ route('orders.create') }}"
                    icon="ri-add-line">{{ __('Create Order') }}</x-action.link>
            </div>
            @include('admin.orders.partials.tab-component')
        </x-slot>
        <x-data-display.data-table :rows="$orders" :columnsToIgnore="['created_at', 'updated_at', 'client_id', 'title', 'description', 'paid_amount']" :appendedColumns="['client_name', 'remaining_date']" :extraActions="[
            [
                'title' => 'Completed',
                'method' => 'get',
                'icon' => 'ri-check-line',
                'route' => 'orders.complete',
            ],
            [
                'title' => 'Cancelled',
                'method' => 'get',
                'icon' => 'ri-close-line',
                'route' => 'orders.cancel',
            ],
            [
                'title' => 'Download Pdf',
                'method' => 'get',
                'icon' => 'ri-download-2-line',
                'route' => 'orders.pdf',
            ],
        ]" />

    </x-data-display.card>
</x-layouts.admin.master>
