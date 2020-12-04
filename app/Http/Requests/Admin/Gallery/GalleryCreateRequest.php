<?php

namespace App\Http\Requests\Admin\Gallery;

use App\Http\Requests\Admin\Request;

class GalleryCreateRequest extends Request
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
            $locale . '.slug' => 'required|max:255|unique:gallery_translations,slug,NULL,id',
        ];
    }
}
