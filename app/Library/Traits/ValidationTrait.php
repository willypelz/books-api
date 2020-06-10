<?php
/***********************************************
 ** File : Validation Trait file
 ** Date: 9th June 2020  *********************
 ** Validation Trait file
 ** Author: Asefon pelumi M. ******************
 ** Senior Software Developer ******************
 * Email: pelumiasefon@gmail.com  ***************
 * ***********************************************/

namespace App\Library\Traits;

use App\Http\Library\RestFullResponse\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait ValidationTrait {

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        $response = [
            'status' => false,
            'message' => (new ApiResponse)->getErrorMessages($validator),
            'data' => [],
            'status_code' => 400
        ];
        throw new HttpResponseException(response($response,400));
    }
}
