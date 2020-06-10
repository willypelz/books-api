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
        return $this->collection->transform(function ($data) {
            return $this->transformData($data);
        })->toArray();
    }

    private function transformData($data)
    {
        return [
            'id' => $data,
//            'name' => $data->name,
//            'isbn' => $data->isbn,
//            'authors' => is_array($data->authors) ? $data->authors : self::formatToArray($data->authors),
//            'number_of_pages' => $data->number_of_pages,
//            'publisher' => $data->publisher,
//            'country' => $data->country,
//            'release_date' => $data->release_date,
        ];
    }

    public function formatToArray($data)
    {
        return array_filter(explode(',', $data));
    }
}
