<?php

/***********************************************
 ** File :  Transformer file
 ** Date: 15th June 2020  *********************
 ** External Transformer file
 ** Author: Asefon pelumi M. ******************
 ** Senior Software Developer ******************
 * Email: pelumiasefon@gmail.com  ***************
 * ***********************************************/

namespace App\Http\Resources\v1;

use Illuminate\Database\Eloquent\Model;

abstract class Transformer extends Model
{
    /**
     * @param array $items
     * @return array
     */
    public  function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}
