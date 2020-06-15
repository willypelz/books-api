<?php


namespace App\Http\Resources\v1;

use Illuminate\Database\Eloquent\Model;

abstract class Transformer extends Model
{
    //

    public  function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}
