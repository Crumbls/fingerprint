<?php

namespace Crumbls\Fingerprint\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FingerprintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
	    return $this->hasValidSignature();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		return [
			'fingerprint' => [
				'required',
				'string',
				'size:32'
			],
			'user_id' => [
				'sometimes'
			]
		];
    }

}
