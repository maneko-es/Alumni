<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\Request;

class RoleCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locale = config('app.fallback_locale');

        return [
            $locale . '.name' => 'required|max:255|unique:role_translations,name,NULL,id'
        ];
    }
}
