<x-layouts.admin.master>

    <x-data-display.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ __('Create Order') }}</h5>
                <x-action.link href="{{ route('orders.index') }}"
                    icon="ri-list-check">{{ __('Order List') }}</x-action.link>
            </div>
        </x-slot>
        <x-data-entry.form action="{{ route('orders.store') }}">
            <x-data-entry.select name="client_id" label="Client Name" placeholder="Client Name" :options="$clients"
                :selected="old('client_id')" label="Select Client" required />
            <x-data-entry.input type="text" name="title" label="Name" placeholder="Name" />
            <x-data-entry.select name='status' label="Status" placeholder="Status" :options="['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'cancelled']" :selected="old('status')"
                label="Select Status" required />
            <x-data-entry.input type="number" name="total_amount" label="Total Amount" placeholder="Total Amount"
                required />
            <x-data-entry.input type="number" name="paid_amount" label="Paid Amount" placeholder="Paid Amount"
                required />
            <x-data-entry.input type="number" name="due_amount" label="Due Amount" placeholder="Due Amount" required />
            <x-data-entry.date-picker name="start_date" label="Start Date" placeholder="Order Date" required />
            <x-data-entry.date-picker name="due_date" label="Due Date" placeholder="Due Date" required />
            <x-data-entry.text-area name="description" label="Description" placeholder="Description" />
        </x-data-entry.form>
    </x-data-display.card>

    @push('scripts')
        <script>
            $(document).ready(function() {
                let totalAmount = 0;
                let paidAmount = 0;
                let dueAmount = 0;
                $('#paid_amount').on('change', function() {
                    totalAmount = $('#total_amount').val();
                    paidAmount = $('#paid_amount').val();
                    dueAmount = totalAmount - paidAmount;
                    $('#due_amount').val(dueAmount);
                });
            });
        </script>
    @endpush
</x-layouts.admin.master>
