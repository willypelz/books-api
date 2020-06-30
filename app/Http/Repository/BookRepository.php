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


use App\Library\Providers\SearchProvider\Factories\ResourceCollectionFactory;
use App\Library\Providers\SearchProvider\Factories\SearchFactory;
use App\Library\Traits\IceAndFireTrait;
use App\Models\Book;
use App\Service\BookService;
use function GuzzleHttp\Promise\all;

class BookRepository
{
    use IceAndFireTrait;

    private $book;
    private $bookService;

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
     * function to get books from external api
     *
     * @return array|string
     */
    public function getAllBooksFromExternal()
    {
        return $this->getWithFilter();
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


    public function searchBookTable($query)
    {

        $searchable_model = SearchFactory::create('book');
        return $searchable_model->search(self::filterInput($query));
    }

}
