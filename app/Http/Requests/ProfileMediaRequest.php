<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileMediaRequest extends FormRequest
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
            'img' => 'mimes:jpeg,jpg,png|max:1000',
        ];

        return $rules;
    }
    public function messages()
    {
       //dd($this->file('media_user_lesson'));
        //$name= $this->file('media_user_lesson');
        $message=[
            'img.mimes' => 'Les imatges han de tenir format jpg o png',
            'img.max' => 'Les imatges no poden pesar més de 1MB',
        ];
        return $message;
    }
}
