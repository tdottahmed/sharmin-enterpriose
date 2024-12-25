<?php

namespace App\Http\Requests\Admin;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'number' => 'nullable|string',
            'address' => 'nullable|string',
            'work_details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function handle($client = null)
    {
        if ($client) {
            $this->update($client, $this->validated());
        } else {
            $client = $this->store($this->validated());
        }
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = uploadFile($data['image'], 'clients');
        }
        $client = Client::create($data);
        return $client;
    }

    public function update(Client $client, array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = uploadFile($data['image'], 'clients');
        }
        $client->update($data);
        return $client;
    }
}
