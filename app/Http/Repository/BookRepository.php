<?php

/************************************
 ** File: Book Repository file  ******
 ** Date: 10th June 2020  ************
 ** Book Repository file  ************
 ** Author: Asefon pelumi M. *********
 ** Senior Software Developer ********
 * Email: pelumiasefon@gmail.com  ***
 * **********************************/

namespace App\Http\Repository;


use App\Library\Providers\SearchProvider\Factories\SearchFactory;
use App\Library\Traits\IceAndFireTrait;
use App\Models\Book;
use App\Service\BookService;
use function GuzzleHttp\Promise\all;

class BookRepository
{

    private $book;
    private $bookService;

    /**
     * BookRepository constructor.
     * @param Book $book
     * @param BookService $bookService
     */
    public function __construct(Book $book, BookService $bookService)
    {
        $this->book = $book;
        $this->bookService = $bookService;
    }


    /**
     * functions to get all books
     *
     * @return Book[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllBooks()
    {
        return $this->book->all();
    }

//     get single book in the application

    /**
     * @param $table_field
     * @param $query
     * @return mixed
     */
    public function getSingleBook($table_field, $query)
    {
        return $this->book->where($table_field, $query)->first();
    }


    /**
     * function to update user details
     *
     * @param $request
     * @return Book
     */
    public function updateBook($request, $id)
    {
        $book = $this->getSingleBook('id', $id);
        if (!$book) return 'Book to be updated not found';
        $book->update($request->toArray());
        return $book;
    }


    /**
     * function to get find a book by its name
     *
     * @param $name
     * @return array
     */
    public function findBookByName($name)
    {
        $query = self::filterInput($name);

        $books = $this->bookService->getFilteredBooks('name', $name);

        if (is_string($books)) return $books;

        return $books;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function filterInput($query)
    {
        return str_replace('"', '', $query);
    }


    /**
     * @param $query
     * @return mixed|string
     */
    public function searchBookTable($query)
    {
        if (self::isSearchableFieldsSupplied($query)) {

            $key = array_key_first($query);

            if ($key == 'release_date') return self::searchTableByDate($key, $query[$key]);

            return self::searchTableByColumn($key, $query[$key]);
        }

        return 'invalid search key supplied';
    }


    /**
     * @param $table
     * @param $query
     * @return mixed
     */
    public function searchTableByColumn($table, $query)
    {
        return $this->book->where($table, 'LIKE', "%$query%")->get();
    }

    /**
     * @param $table
     * @param $query
     * @return mixed
     */
    public function searchTableByDate($table, $query)
    {
        return $this->book->whereDate($table, $query)->get();
    }

    /**
     * @param $data
     * @return int
     */
    public function isSearchableFieldsSupplied($data)
    {
        return count(array_intersect(array_keys($data), Book::$searchable_fields));
    }

}
