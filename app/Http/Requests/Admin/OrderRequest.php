<?php

namespace App\Http\Requests\Admin;

use App\Models\ClientOrderDocument;
use App\Models\Order;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && ($user->can('create orders') || $user->can('update orders'));
    }

    public function rules(): array
    {
        return [
            'status' => 'required',
            'title' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:clients,id',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|lte:total_amount',
            'due_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'documents' => 'nullable|array',
        ];
    }

    public function handle($order = null)
    {
        $data = $this->validated();

        if ($order) {
            $this->updateOrder($order, $data);
        } else {
            $order = $this->storeOrder($data);
        }

        return $order;
    }

    public function storeOrder($data)
    {
        $order = Order::create(Arr::except($data, 'documents'));
        if (isset($data['documents'])) {
            $this->storeDocuments($order, $data['documents']);
        }
        return $order;
    }

    public function updateOrder($order, $data)
    {
        $order->update(Arr::except($data, 'documents'));
        if (isset($data['documents'])) {
            $this->storeDocuments($order, $data['documents']);
        }
        return $order;
    }

    public function storeDocuments($order, $documents)
    {
        foreach ($documents as $document) {
            try {
                $documentPath = filepondUpload($document, 'orders/documents');
                ClientOrderDocument::create([
                    'client_id' => $order->client_id,
                    'order_id' => $order->id,
                    'document' => $documentPath
                ]);
            } catch (\Exception $e) {
                Log::error('Document upload failed: ' . $e->getMessage());
            }
        }
    }
}
