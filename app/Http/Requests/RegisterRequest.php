<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
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

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ];

        $unique_rules = [];

        //1 = google, 2= facebook, default = normal
        switch ($this->input('register')) {
            case 1:
                $unique_rules['google_id'] = ['required','string', 'max:255'];
                break;
            case 2:
                $unique_rules['facebook_id'] = ['required', 'string', 'max:255'];
                break;
            default:
                $unique_rules['password'] = 'required|confirmed';
        }

        return $rules + $unique_rules;
    }
}
