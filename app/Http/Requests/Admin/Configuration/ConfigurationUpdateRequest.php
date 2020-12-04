<?php

namespace App\Http\Requests\Admin\Configuration;

use App\Http\Requests\Admin\Request;

use App;

class ConfigurationUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
             'main_mail' => 'required',
        ];
    }
}
