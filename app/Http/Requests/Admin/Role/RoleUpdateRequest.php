<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\Request;

use App;
use App\RoleTranslation;

class RoleUpdateRequest extends Request
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

            $entry_translation = RoleTranslation::where('role_id', $entry_id)
                ->where('locale', $locale)
                ->first();

            if ($entry_translation) {
                $translation_id = $entry_translation->id;
            }
        }

        return [
            $locale . '.name' =>
                'required|max:255|unique:role_translations,name,' . $translation_id . ',id,locale,' . $locale,
        ];
    }
}
