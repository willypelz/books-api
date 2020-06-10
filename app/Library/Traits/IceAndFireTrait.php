<?php

namespace App\Library\Traits;

use App\Http\Library\RestFullResponse\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

trait IceAndFireTrait
{
    public function getIceAndFireBooks()
    {
        try {
            return (Http::get('https://www.anapioficeandfire.com/api/books'))->json();
        } catch (\Exception $e) {
            return 'error getting book from external source';
        }
    }
}
