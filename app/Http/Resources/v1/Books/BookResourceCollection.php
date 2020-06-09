<?php

namespace App\Http\Resources\v1\Books;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param $data
     * @return array
     */
    public function toArray($data)
    {
        return $this->collection->transform(function ($data){
            return $this->transformData($data);
        })->toArray();
    }

    private function transformData($data)
    {
        return [
            'name' => $data->name,
        ];
    }
}
