<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:pending,completed'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => __('validation.The_title_field_is_required.'),
            'title.string' => __('validation.The_title_must_be_a_string.'),
            'title.max' => __('validation.The_title_may_not_be_greater_than_255_characters.'),
            'status.required' => __('validation.The_status_field_is_required.'),
            'status.in' => __('validation.The_selected_status_is_invalid.'),
            'user_id.required' => __('validation.The_user_ID_field_is_required.'),
            'user_id.exists' => __('validation.The_selected_user_does_not_exist.'),
        ];
    }
}
