<?php

/************************************
 ** File: Book Resource file  ******
 ** Date: 9th June 2020  ************
 ** Book Resource file  ************
 ** Author: Asefon pelumi M. *********
 ** Senior Software Developer ********
 * Email: pelumiasefon@gmail.com  ***
 * **********************************/


namespace App\Http\Resources\v1\Books;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $data
     * @return array
     */
    public function toArray($data)
    {
        return [
            'id' => $data['id'],
            'name' => $data->name,
            'isbn' => $data->isbn,
            'authors' => is_array($data->authors) ? $data->authors : self::formatToArray($data->authors),
            'number_of_pages' => $data->number_of_pages,
            'publisher' => $data->publisher,
            'country' => $data->country,
            'release_date' => $data->release_date,
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function formatToArray($data)
    {
        return array_filter(explode(',', $data));
    }
}
