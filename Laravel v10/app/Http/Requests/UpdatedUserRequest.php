<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdatedUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route()->parameter('user');
        return User::where('id', $id)->exists();
    }

    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('Usuário não encontrado!');
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = $this->route()->parameter('user');
        // pegando o id do usuário que está sendo atualizado, para que se o email for o mesmo cadastrado no email anteriormente não apresente erro de duplicação de email
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email,{$userId}",
            "date_of_birth" => "nullable|date|before:today",

        ];
    }
}
