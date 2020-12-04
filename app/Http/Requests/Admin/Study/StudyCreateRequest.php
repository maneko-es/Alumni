<?php

namespace App\Http\Requests\Admin\Study;

use App\Http\Requests\Admin\Request;

class StudyCreateRequest extends Request
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
