<?php

namespace busRegistration\Http\Requests;

use busRegistration\Parents;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class storeParent extends FormRequest
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

        // extends Validator only for this request
        \Validator::extend( 'composite_unique', function ( $attribute, $value, $parameters, $validator ) {

            // remove first parameter and assume it is the table name
            $table = array_shift( $parameters );

            // start building the conditions
            $fields = [ $attribute => $value ]; // current field, company_code in your case

            // iterates over the other parameters and build the conditions for all the required fields
            while ( $field = array_shift( $parameters ) ) {
                $fields[ $field ] = $this->get( $field );
            }

            // query the table with all the conditions
            $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $fields )->first();

            return empty( $result ); // edited here
        }, 'It would seem you have already registered this year.' );



        return [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => ['required', 'email', 'confirmed', 'composite_unique:parents,year'],
            'primary_phone' => 'required|max:20',
            'secondary_phone' => 'required|max:20',
            'address' => 'required|max:50',
            'city' => 'required|max:20',
            'province' => 'required|max:20',
            'postal_code' => 'required|max:20',
            'year' => 'required'
        ];
    }


    public function persist()
    {
        $parent = new Parents();

        return  $parent->fill(request()->all())->save();
    }


}
