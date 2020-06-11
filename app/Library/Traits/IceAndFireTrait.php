<?php
/***********************************************
 ** File : Ice And Fire Trait file
 ** Date: 9th June 2020  *********************
 ** Ice And Fire Trait file
 ** Author: Asefon pelumi M. ******************
 ** Senior Software Developer ******************
 * Email: pelumiasefon@gmail.com  ***************
 * ***********************************************/

namespace App\Library\Traits;

use App\Http\Library\RestFullResponse\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

trait IceAndFireTrait
{
    /**
     * @return array|string
     */
    public function getIceAndFireBooks()
    {
        try {
            return (Http::get('https://www.anapioficeandfire.com/api/books'))->json();
            //            return (Http::get($_ENV['ICE_AND_FIRE_URL']))->json();
        } catch (\Exception $e) {
            return 'error getting book from external source';
        }
    }
}
