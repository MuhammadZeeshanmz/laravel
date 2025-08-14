<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:30|unique:tasks,title',
            'description' => 'nullable|string|max:255',
            'assigned_at' => 'nullable|date',
        ];
        
    }
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 30 characters.',
            'title.unique' => 'The title has already been taken.',
            
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'assigned_at.date' => 'The assigned at must be a valid date.',
      
        ];
    }
//     public function failedValidation(Validator $validator)
// {
//     throw new HttpResponseException(response()->json([
//         // 'success' => false,
//         // 'message' => 'Validation errors',
//         'errors' => $validator->errors()
//     ], 422));
// }
public function failedValidation(Validator $validation)
{
    throw new HttpResponseException(response()->json([
        'error'=> $validation->errors()
    ], 422));
}
    


}
