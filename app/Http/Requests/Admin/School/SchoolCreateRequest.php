<?php

namespace App\Http\Requests\Admin\School;

use App\Http\Requests\Admin\Request;

class SchoolCreateRequest extends Request
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
            $locale . '.title' => 'required|max:255',
            $locale . '.slug' => 'required|max:255|unique:school_translations,slug,NULL,id',
        ];
    }
}
