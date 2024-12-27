<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Order Details') }}</h5>
                <x-action.link href="{{ route('orders.index') }}"
                    icon="ri-list-check">{{ __('Order List') }}</x-action.link>
            </div>
        </x-slot>

        <!-- Order Information Section -->


        <ul class="list-group">
            <li class="list-group-item"><i class="ri-bill-line align-middle me-2"></i> {{ __('Client Name:') }}
                {{ $client->name }}</li>
            <li class="list-group-item"><i class="ri-file-copy-2-line align-middle me-2"></i> {{ __('Client Email:') }}
                {{ $client->email }}</li>
            <li class="list-group-item"><i class="ri-question-answer-line align-middle me-2"></i>
                {{ __('Client Phone:') }} {{ $client->number }}</li>
            <li class="list-group-item"><i class="ri-secure-payment-line align-middle me-2"></i>
                {{ __('Client Address:') }} {{ $client->address }}</li>
            <li class="list-group-item"><i class="ri-secure-payment-line align-middle me-2"></i>
                {{ __('Client Working Details:') }} {{ $client->work_details }}</li>
        </ul>


        <hr>
        <h5>{{ __('Client Orders:') }}</h5>
        <x-data-display.data-table :rows="$client->orders" :columnsToIgnore="['created_at', 'updated_at', 'client_id', 'title', 'description', 'paid_amount']" :appendedColumns="['client_name', 'remaining_date']" :extraActions="[
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
