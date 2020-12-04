<?php

namespace App\Http\Requests\Admin\Registry;

use App\Http\Requests\Admin\Request;

class RegistryCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locale = config('app.locale');

        return [
            'name' => 'required|max:255',
        ];
    }
}
