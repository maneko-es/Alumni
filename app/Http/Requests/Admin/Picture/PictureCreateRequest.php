<?php

namespace App\Http\Requests\Admin\Picture;

use App\Http\Requests\Admin\Request;

class PictureCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        return [
            'gallery_id' => 'required',
        ];
    }
}
