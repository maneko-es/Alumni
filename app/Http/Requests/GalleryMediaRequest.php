<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       // dd($this->input('media_user_lesson'));
        return [
            'pictures' => 'required|max:20',
            'pictures.*' => 'mimes:jpeg,jpg|max:1000',
        ];

        return $rules;
    }
    public function messages()
    {
       //dd($this->file('media_user_lesson'));
        //$name= $this->file('media_user_lesson');
        $message=[
            'pictures.*.mimes' => 'Les imatges han de tenir format jpg',
            'pictures.*.max' => 'Les imatges no poden pesar més de 1MB cada una',
        ];
        return $message;
    }
}
