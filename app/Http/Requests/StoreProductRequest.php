<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * The url that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected $redirect = '/create#createForm';

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
            'title' => 'required|string',
            'subcategory' => 'required',
            'price' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:png,jpg',
            'description' => 'required|string'
        ];
    }
}
