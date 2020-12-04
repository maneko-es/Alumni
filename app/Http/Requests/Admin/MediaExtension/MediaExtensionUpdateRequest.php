<?php

namespace App\Http\Requests\Admin\MediaExtension;

use App\Http\Requests\Admin\Request;

class MediaExtensionUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:4|unique:media_extensions,name,' . $this->id . ',id',
        ];
    }
}
