<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cognome' => 'required|between:4,25',
            'indirizzo' => '',
            'cellulare' => 'numeric',
            'codice_fiscale' => 'size:16',
            'sede' => '',
            'ddn' => 'date|after:01-01-1910|before:01-01-2005'
        ];
    }
}
