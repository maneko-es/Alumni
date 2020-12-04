<?php

namespace App\Http\Requests\Admin\Block;

use App\Http\Requests\Admin\Request;

class BlockCreateRequest extends Request
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
        ];
    }
}
