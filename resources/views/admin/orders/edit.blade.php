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
            <x-data-entry.input type="number" name="original_cost" label="Original Cost" placeholder="Original Cost"
                :value="$order->original_cost" required />
            <x-data-entry.input type="number" name="profit" label="Profit" placeholder="Profit" :value="$order->profit" />
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
            <div class="d-flex gap-4">
                @foreach ($order->documents as $document)
                    @php
                        $filePath = asset('storage/' . $document->document); // Full path to the file
                        $extension = pathinfo($document->document, PATHINFO_EXTENSION); // Get file extension
                    @endphp

                    <div class="document-preview">
                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <!-- Image Preview -->
                            <img src="{{ $filePath }}" alt="Image" class="img-thumbnail"
                                style="max-width: 200px; height: auto;">
                        @elseif(strtolower($extension) === 'pdf')
                            <!-- PDF Preview -->
                            <embed src="{{ $filePath }}" type="application/pdf" width="400" height="500">
                            <!-- OR Use iframe if embed isn't supported -->
                            {{-- <!-- <iframe src="{{ $filePath }}" width="400" height="500"></iframe> --> --}}
                        @else
                            <!-- Default: File download link -->
                            <a href="{{ $filePath }}" target="_blank" class="btn btn-primary">Download
                                {{ strtoupper($extension) }}</a>
                        @endif
                    </div>
                @endforeach

            </div>
            <x-data-entry.uploader-filepond name="documents" label="Documents" multiple=true />
        </x-data-entry.form>
    </x-data-display.card>
</x-layouts.admin.master>
