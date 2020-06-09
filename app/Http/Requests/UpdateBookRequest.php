<?php

namespace App\Http\Requests;

use App\Library\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{

    use ValidationTrait;

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
            'name' => 'required',
            'isbn' => 'required|',
            'authors' => 'required|',
            'number_of_pages' => 'required|integer',
            'publisher' => 'required|',
            'country' => 'required|',
//            'release_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'isbn.required' => 'The isbn field is required',
            'authors.required' => 'The authors field is required',
            'number_of_pages.required' => 'The number_of_pages field is required',
            'publisher.required' => 'The publisher field is required',
            'country.required' => 'The country field is required',
            'release_date.required' => 'The release_date field is required',
        ];
    }
}
