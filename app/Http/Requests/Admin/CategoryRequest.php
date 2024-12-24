<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:255|unique:categories,name,',
            'description' => 'nullable',
        ];
    }

    public function handle($category = null)
    {
        if ($category) {
            $this->update($category, $this->validated());
        } else {
            $category = $this->store($this->validated());
        }
        return $category;
    }

    public function store($data)
    {
        DB::transaction(function () use ($data) {
            return Category::create($data);
        });
    }

    public function update(Category $category, $data)
    {
        DB::transaction(function () use ($category, $data) {
            $category->update($data);
        });
    }
}
