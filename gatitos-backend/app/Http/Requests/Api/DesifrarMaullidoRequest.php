<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DesifrarMaullidoRequest extends FormRequest
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
     * @return array<string>, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'maullido'              => ['required', 'string', 'max:20', 'regex:/^[a-z]+$/'],
            'diccionarioFelino'     => ['required', 'array', 'max:1000'],
            'diccionarioFelino.*'   => ['required', 'string', 'min:1', 'max:10', 'regex:/^[a-z]+$/'],
        ];
    }
    /**
     * Mensajes de error personalizados para las reglas de validación
     * Clave: "campo.regla" | Valor: Mensaje (usar :attribute para el nombre del campo).
     * @return array
     */
    public function messages()
    {
        return [
            'maullido.required'             => 'Debe ingresar el maullido a desifrar.',
            'maullido.string'               => 'El maullido ingresado no es valido',
            'maullido.max'                  => 'El maullido es demasiado grande para desifrar',
            'maullido.regex'                => 'El maullido ingresado no es valido.',
            'diccionarioFelino.required'    => 'Debe ingrsar el diccionario felino.',
            'diccionarioFelino.array'       => 'El diccionario no tiene el formato correcto',
            'diccionarioFelino.max'         => 'El diccionario felino es demasiado grande para ejecutarlo',
            'diccionarioFelino.*'           => 'Cada elemento debe ser una palabra de 1 a 10 letras minúsculas (a-z) sin números ni símbolos.',
        ];
    }
}
