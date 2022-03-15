<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:10',
            'description' => 'required',
            'text' => 'required',
            'date' => 'required|date',
            'active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название обязательно',
            'name.max' => 'Название не должно превышать 10 символов',
            'description.required' => 'Описание обязательно',
            'text.required' => 'Текст обязательно',
            'date.required' => 'Дата обязательно',
            'date.date' => 'Формат даты не правильно',
            'active.required' => 'Признак публикации обязательно',
            'active.boolean' => 'Признак публикации не правильно',
        ];
    }
}
