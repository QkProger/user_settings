<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$userId},id|max:255",
            'real_password' => 'required|string|min:8|max:255',
        ];
    }
}
