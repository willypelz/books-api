<?php

namespace App\Http\Resources\v1\Books;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
