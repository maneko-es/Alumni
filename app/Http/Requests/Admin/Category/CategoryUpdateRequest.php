<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\Request;

use App;
use App\CategoryTranslation;

class CategoryUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $entry_id = null;
        $translation_id = null;
        $locale = $this->request->get('locale');

        if ($this->isMethod('PUT')) {
            $entry_id = $this->request->get('id');

            $entry_translation = CategoryTranslation::where('category_id', $entry_id)
                ->where('locale', $locale)
                ->first();

            if ($entry_translation) {
                $translation_id = $entry_translation->id;
            }
        }

        return [
            $locale . '.title' => 'required|max:255',
            $locale . '.slug' =>
                'required|max:255|unique:category_translations,slug,' . $translation_id . ',id,locale,' . $locale,
        ];
    }
}
