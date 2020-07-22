<?php

namespace App\Http\Requests;

use App\DateKeys\Date\DatePolicy;
use App\DateKeys\KeyLettersPolicy;
use Illuminate\Foundation\Http\FormRequest;

class PostDateKeysBatch extends FormRequest
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
    public function rules(DatePolicy $datePolicy, KeyLettersPolicy $keyLettersPolicy)
    {
        return [
            'range-start' => 'required|date|date_format:Y-m-d|',
            'range-stop' => 'required|date|date_format:Y-m-d',
            'uuid' => 'required|uuid',
            'letters' => "required|array|between:{$keyLettersPolicy->countFrom()},{$keyLettersPolicy->countTo()}",
        ];
    }
}
