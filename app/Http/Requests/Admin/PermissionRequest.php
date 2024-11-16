<?php

namespace App\Http\Requests\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name' => 'required|max:255|unique:permissions,name,' . $this->route('permission')->id,
            'guard_name' => 'nullable|max:255',
            'group_name' => 'required|max:255',
        ];
    }

    public function handle($permission = null)
    {
        if ($permission) {
            $this->update($permission, $this->validated());
        } else {
            $permission = $this->store($this->validated());
        }
        return $permission;
    }

    public function store($data)
    {
        return Permission::create($data);
    }

    public function update(Permission $permission, $data)
    {
        $permission->update($data);
        return $permission;
    }
}
