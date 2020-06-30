<?php


namespace App\Service;


use App\Library\Traits\IceAndFireTrait;

class BookService
{
    use IceAndFireTrait;


    /**
     * Filtering api response book with any of the available parameter
     * supported by the ice and fire endpoint.
     * @param $params
     * @param $query
     * @return array|string
     */
    public function getFilteredBooks($params, $query)
    {
        return $this->getWithFilter("books?$params=$query");
    }

}
