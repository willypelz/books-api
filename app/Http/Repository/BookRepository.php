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


use App\Library\Traits\IceAndFireTrait;
use App\Models\Book;
use function GuzzleHttp\Promise\all;

class BookRepository
{
    use IceAndFireTrait;

    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
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
    public function updateUser($request, $id)
    {
       $book = $this->getSingleBook('id', $id);
        if(!$book) return 'Book to be updated not found';
        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->authors = @$request->authors;
        $book->country = @$request->country;
        $book->number_of_pages = @$request->number_of_pages;
        $book->publisher = @$request->publisher;
        $book->release_date = @$request->release_date;
        $book->save();
        return $book;
    }


    /**
     * function to get books from external api
     *
     * @return array|string
     */
    public function getAllBooksFromExternal()
    {
        return $this->getIceAndFireBooks();
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

        $bookCollection = array();

        $books = $this->getAllBooksFromExternal();

        if (is_string($books)) return $books;

        for ($bk = 0; $bk < count($books); $bk++) {
            if ($books[$bk]['name'] == $query) {
                array_push($bookCollection, $books[$bk]);
            }
        }

        return $bookCollection;

//       alternative is to use laravel filter collect helper function or recursion method
        /**
         * $filteredBook = collect($books)->filter(
         * function ($book) use ($query) {
         * return ($book['name'] == $query) ??   $book ;
         * });
         */
    }

    /**
     * @param $query
     * @return mixed
     */
    public function filterInput($query){
       return  str_replace('"', '', $query);
    }

}
