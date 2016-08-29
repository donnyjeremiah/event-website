<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateEventFormRequest extends Request
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
        return [
          'name' => 'bail|required|string|max:255|unique:events,name', // varchar max is 255. NO NEED UNIQUE
          'type' => 'bail|required',
          'poster.*' => 'bail|mimes:jpg,jpeg,bmp,png',
          'description' => 'bail|required|max:800',
          'days' => 'bail|required',
          'date_start' => 'bail|required|date_format:"d/m/Y"',
          'date_end' => 'bail|date_format:d/m/Y|after:date_start',
          'time' => 'bail|required',
          'line_1' => 'bail|required|max:50',
          'line_2' => 'bail|required|max:50',
          'landmark' => 'bail|max:50',
          'country' => 'bail|required',
          'state' => 'bail|required',
          'city' => 'bail|required',
          'zip' => 'bail|required|digits:6',
          'latitude' => 'bail|required|numeric',
          'longitude' => 'bail|required|numeric'
        ];
    }
}
