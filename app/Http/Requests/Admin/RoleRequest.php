<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function handle()
    {
        if($this->isMethod('post')) {
            return $this->store();
        }
        if($this->isMethod('put')||$this->isMethod('patch')) {
            return $this->update();
        }
    }

    public function store()
    {
       Role::create($this->validated());
    }
}
