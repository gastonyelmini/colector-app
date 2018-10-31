<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StroreDniRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dni' => 'required|numeric|min:0'
        ];
    }
}
