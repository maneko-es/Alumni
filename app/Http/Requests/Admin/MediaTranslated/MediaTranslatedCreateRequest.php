<?php

namespace App\Http\Requests\Admin\MediaTranslated;

use App\Http\Requests\Admin\Request;
use App\MediaExtension;

class MediaTranslatedCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $extensions = MediaExtension::getExtensionsString();

        return [
            'file' => 'required|mimes:' . $extensions,
        ];
    }
}
