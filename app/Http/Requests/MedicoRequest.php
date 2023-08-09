<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\RequirableTrait;
use Illuminate\Foundation\Http\FormRequest;

class MedicoRequest extends FormRequest
{
    use RequirableTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => [$this->requirable()],
            'especialidade' => [$this->requirable()],
            'cidade_id' => [$this->requirable(), 'exists:cidades,id'],
        ];
    }
}
