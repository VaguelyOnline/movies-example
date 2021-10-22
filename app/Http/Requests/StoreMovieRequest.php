<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:1000|min:3',
            'description' => 'required',
            'image' => 'required|url',
            'director_id' => 'required|exists:directors,id'
        ];
    }
}
