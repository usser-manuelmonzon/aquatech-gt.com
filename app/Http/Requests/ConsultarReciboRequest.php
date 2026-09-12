<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultarReciboRequest extends FormRequest
{
    /**
     * La consulta de recibos es pública.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpia los datos antes de aplicar las validaciones.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'dpi' => trim((string) $this->dpi),
            'numero_contador' => trim((string) $this->numero_contador),
        ]);
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'dpi' => [
                'required',
                'string',
                'regex:/^\d{13}$/',
            ],

            'numero_contador' => [
                'required',
                'string',
                'max:50',
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'dpi.required' =>
                'Ingrese el DPI del titular.',

            'dpi.regex' =>
                'El DPI debe contener exactamente 13 dígitos.',

            'numero_contador.required' =>
                'Ingrese el número de contador.',

            'numero_contador.max' =>
                'El número de contador no puede superar los 50 caracteres.',
        ];
    }

    /**
     * Nombres amigables de los campos.
     */
    public function attributes(): array
    {
        return [
            'dpi' => 'DPI',
            'numero_contador' => 'número de contador',
        ];
    }
}