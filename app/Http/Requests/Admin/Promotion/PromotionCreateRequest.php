<?php

namespace App\Http\Requests\Admin\Promotion;

use App\Http\Requests\Admin\Request;

class PromotionCreateRequest extends Request
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
            $locale . '.title' => 'required|max:255|unique:promotion_translations,title,NULL,id',
            $locale . '.slug' => 'required|max:255|unique:promotion_translations,slug,NULL,id',
        ];
    }
}
