<?php

namespace App\Http\Requests\Admin\Study;

use App\Http\Requests\Admin\Request;

use App;

class StudyUpdateRequest extends Request
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
        ];
    }
}
