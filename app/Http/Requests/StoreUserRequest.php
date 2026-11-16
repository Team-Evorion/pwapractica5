<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', User::class) ?? false;
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', Password::min(8)],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'role_id.required' => 'Selecciona un rol.',
            'role_id.integer' => 'El rol seleccionado no es válido.',
            'role_id.exists' => 'El rol seleccionado no existe.',
            'name.required' => 'Ingresa el nombre completo.',
            'name.max' => 'El nombre no puede superar los 50 caracteres.',
            'email.required' => 'Ingresa el correo electrónico.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede superar los 100 caracteres.',
            'email.unique' => 'Ya existe una cuenta con este correo electrónico.',
            'password.required' => 'Ingresa una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password_confirmation.required' => 'Confirma la contraseña.',
            'password_confirmation.same' => 'La confirmación de contraseña no coincide.',
        ];
    }
}
