<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Admin\Request;

class UserCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
           
        ];
    }
}
