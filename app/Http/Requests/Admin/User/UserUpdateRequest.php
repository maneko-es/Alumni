<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Admin\Request;

class UserUpdateRequest extends Request
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
            'email' => 'required|email|max:255|unique:users,email,' . $this->id . ',id',
            'roles' => 'required|array'
        ];
    }
}
