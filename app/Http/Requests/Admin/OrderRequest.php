<?php

namespace App\Http\Requests\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && ($user->can('create orders') || $user->can('update orders'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required',
            'title' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:clients,id',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'description' => 'nullable|string',
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
        return Order::create($data);
    }

    public function updateOrder($order, $data)
    {
        $order->update($data);
        return $order;
    }
}
