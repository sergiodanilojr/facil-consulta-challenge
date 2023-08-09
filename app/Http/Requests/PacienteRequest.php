<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\RequirableTrait;
use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'nome' => [$this->requirableRule()],
            'cpf' => [$this->requirableRule(), $this->uniqueRuleToCpfField()],
            'celular' => [$this->requirableRule()],
        ];
    }

    public function requirableRule()
    {
        if ($this->isUpdating()){
            return 'nullable';
        }

        return 'required';
    }

    private function uniqueRuleToCpfField()
    {
        $rule = 'unique:pacientes,cpf';

        if ($this->isUpdating()) {
            $rule .= "," . $this->route('paciente');
        }

        return $rule;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cpf' => preg_replace("/[^0-9]/", '', $this->get('cpf')),
            'celular' => preg_replace("/[^0-9]/", '', $this->get('celular')),
        ]);
    }
}
