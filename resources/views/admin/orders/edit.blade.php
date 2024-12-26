<x-layouts.admin.master>
    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Edit Order') }}</h5>
                <x-action.link href="{{ route('orders.index') }}"
                    icon="ri-list-check">{{ __('Order List') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-entry.form action="{{ route('orders.update', $order->id) }}" model="{{ $order }}">
            <x-data-entry.select name="client_id" label="Client Name" placeholder="Client Name" :options="$clients"
                :selected="$order->client_id" label="Select Client" required />
            <x-data-entry.input type="text" name="title" label="Name" placeholder="Name" :value="$order->title"
                required />
            <x-data-entry.select name='status' label="Status" placeholder="Status" :options="['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'cancelled']" :selected="$order->status"
                label="Select Status" required />
            <x-data-entry.input type="number" name="total_amount" label="Total Amount" :value="$order->total_amount"
                placeholder="Total Amount" required />
            <x-data-entry.input type="number" name="paid_amount" label="Paid Amount" placeholder="Paid Amount"
                :value="$order->paid_amount" required />
            <x-data-entry.input type="number" name="due_amount" label="Due Amount" placeholder="Due Amount"
                :value="$order->due_amount" required />
            <x-data-entry.date-picker name="start_date" label="Start Date" placeholder="Order Date" :value="$order->start_date"
                required />
            <x-data-entry.date-picker name="due_date" label="Due Date" placeholder="Due Date" :value="$order->due_date"
                required />
            <x-data-entry.text-area name="description" label="Description" placeholder="Description"
                :value="$order->description" />
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
