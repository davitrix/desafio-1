<?php

namespace App\Http\Requests\Criptomoneda;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:criptomonedas,nombre,' . $this->route('criptomoneda'),
            'simbolo' => 'required|string|max:10|unique:criptomonedas,simbolo,' . $this->route('criptomoneda'),
            'tecnologia' => 'required|string|max:255',

            'monedas' => 'array',
            'monedas' => 'max:5', // Limitar a un máximo de 5 monedas asociadas
            'monedas' => 'min:1', // Asegurar que al menos una moneda esté asociada
            'monedas.*.id' => 'distinct', // Asegurar que no haya duplicados en el array de monedas
            'monedas.*.id' => 'exists:monedas,id', // Validar que cada ID de moneda exista en la tabla monedas
            'monedas.*.precio' => 'required|numeric|min:0', // Validar que cada precio de moneda sea numérico y no negativo
        ];
    }
}
