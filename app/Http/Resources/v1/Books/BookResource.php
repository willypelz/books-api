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

use App\Http\Resources\v1\Transformer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends Transformer
{
    /**
     * Transform the resource into an array.
     *
     * @param $data
     * @return array
     */
    public function transform($data)
    {
        if (is_array($data)) $data = (object)$data;

        $response_data = [
            'name' => $data->name,
            'isbn' => $data->isbn,
            'authors' => is_array($data->authors) ? $data->authors : self::formatToArray($data->authors),
            'number_of_pages' => $data->number_of_pages,
            'publisher' => $data->publisher,
            'country' => $data->country,
            'release_date' => $data->release_date,
        ];

        if (isset($data->hide_id) && $data->hide_id) {
            return $response_data;
        } else {
            $data_ = ['id' => $data->id];
            return array_merge($data_, $response_data);

        }
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
