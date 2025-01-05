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
        <div class="order-details mt-4">
            <h3 class="mb-3">{{ __('Title:') }} <span class="text-muted">{{ $order->title }}</span></h3>

            <h3 class="mb-3">{{ __('Client:') }} <span class="text-muted">{{ $order->client_name }}</span></h3>

            <p class="mb-3">
                <strong>{{ __('Status:') }}</strong>
                <span
                    class="badge {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-success') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>

            <p class="mb-3">
                <strong>{{ __('Original Cost:') }}</strong>
                <span class="text-success">{{ number_format($order->original_cost, 2) }}</span>
            </p>
            <p class="mb-3">
                <strong>{{ __('Profit:') }}</strong>
                <span class="text-success">{{ number_format($order->profit, 2) }}</span>
            </p>
            <p class="mb-3">
                <strong>{{ __('Total Amount:') }}</strong>
                <span class="text-success">{{ number_format($order->total_amount, 2) }}</span>
            </p>

            <p class="mb-3">
                <strong>{{ __('Paid Amount:') }}</strong>
                <span class="text-primary">{{ number_format($order->paid_amount, 2) }}</span>
            </p>

            <p class="mb-3">
                <strong>{{ __('Due Amount:') }}</strong>
                <span class="text-danger">{{ number_format($order->due_amount, 2) }}</span>
            </p>

            <p class="mb-3">
                <strong>{{ __('Start Date:') }}</strong>
                <span class="text-muted">{{ \Carbon\Carbon::parse($order->start_date)->format('d M, Y') }}</span>
            </p>

            <p class="mb-3">
                <strong>{{ __('Due Date:') }}</strong>
                <span class="text-muted">{{ \Carbon\Carbon::parse($order->due_date)->format('d M, Y') }}</span>
            </p>
        </div>

        <h6>{{ __('Order Description:') }}</h6>
        <p>{{ $order->description }}</p>
        <hr>
        <h6>{{ __('Order Documents:') }}</h6>
        <div class="d-flex gap-4">
            @foreach ($order->documents as $document)
                @php
                    $filePath = asset('storage/' . $document->document); // Full path to the file
                    $extension = pathinfo($document->document, PATHINFO_EXTENSION); // Get file extension
                @endphp
                <div class="document-preview">
                    @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <img src="{{ $filePath }}" alt="Image" class="img-thumbnail"
                            style="max-width: 200px; height: auto;">
                    @elseif(strtolower($extension) === 'pdf')
                        <embed src="{{ $filePath }}" type="application/pdf" width="400" height="500">
                    @else
                        <a href="{{ $filePath }}" target="_blank" class="btn btn-primary">Download
                            {{ strtoupper($extension) }}</a>
                    @endif
                </div>
            @endforeach
        </div>
    </x-data-display.card>
</x-layouts.admin.master>
