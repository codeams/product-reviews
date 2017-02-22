<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
          'name' => [ 'required', 'string' ],
          'price' => [ 'required', 'numeric', 'min:0' ],
          'description' => [ 'required', 'string' ],
          'seller_id' => [ 'required', 'exists:sellers,id' ],
          'tags' => [ 'array' ]
        ];

        $tags = $this->request->get( 'tags' );

        if ( is_array( $tags ) )
        {
          foreach( $tags as $key => $val )
          {
            $rules['tags.'.$key] = 'required|string';
          }
        }

        return $rules;
    }
}
