<?php


namespace App\Http\Repository;


use App\Models\Book;
use function GuzzleHttp\Promise\all;

class BookRepository
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }


    public function getAllBooks()
    {
        return $this->book - all();
    }

    public function getSingleBook()
    {
        return
    }

}
