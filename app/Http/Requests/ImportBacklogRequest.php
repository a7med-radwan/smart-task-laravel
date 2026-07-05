<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportBacklogRequest extends FormRequest
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
            'tasks'                         => ['required', 'array', 'min:1'],
            'tasks.*.title'                 => ['required', 'string', 'max:255'],
            'tasks.*.description'           => ['nullable', 'string'],
            'tasks.*.priority'              => ['required', 'in:high,medium,low'],
            'tasks.*.sprint_name'           => ['required', 'string', 'max:255'],
            'tasks.*.sprint_goal'           => ['nullable', 'string'],
            'tasks.*.sprint_duration_weeks' => ['nullable', 'integer'],
            'tasks.*.story_points'          => ['nullable', 'integer'],
            'tasks.*.project_name'          => ['nullable', 'string', 'max:255'],
            'tasks.*.sprint_index'          => ['nullable', 'integer'],
            'tasks.*.due_time'              => ['nullable', 'string'],
        ];
    }
}
