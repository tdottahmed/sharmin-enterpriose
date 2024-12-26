<?php

namespace App\Http\Requests\Admin;

use App\Models\Note;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
        ];
    }

    public function handle($note = null)
    {
        if ($note) {
            $this->update($this->validated(), $note);
        } else {
            $note = $this->store($this->validated());
        }
        return $note;
    }

    public function store(array $data)
    {
        return Note::create([
            'user_id' => auth()->user()->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function update(array $data,  $note)
    {
        return $note->update($data);
    }
}
