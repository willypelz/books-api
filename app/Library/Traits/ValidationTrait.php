<?php
namespace App\Library\Traits;

use App\Http\Library\RestFullResponse\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait ValidationTrait {
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
