<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BookStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'isbn' => 'required|numeric',
            'value' => 'required|decimal:2',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'You need to specify the name.',
            'isbn.required' => 'You need to specify the ISBN.',
            'value.required' => 'You need to specify the value.',
        ];
    }

    public function failedValidation(Validator $validator): ValidationException
    {
        $response = new Response(['errors' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
}
