<?php

/************************************
 ** File: Book Controller file  ******
 ** Date: 9th June 2020  ************
 ** Book Controller file  ************
 ** Author: Asefon pelumi M. *********
 ** Senior Software Developer ********
 * Email: pelumiasefon@gmail.com  ***
 * **********************************/

namespace App\Http\Controllers\Api\v1\Books;

use App\Http\Controllers\Controller;
use App\Http\Library\RestFullResponse\ApiResponse;
use App\Http\Repository\BookRepository;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\v1\Books\BookResource;
use App\Http\Resources\v1\Books\BookResourceCollection;
use App\Http\Resources\v1\Books\ExternalBookResourceCollection;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    protected $bookRepository;
    protected $apiResponse;


    /**
     * BooksController constructor.
     * @param BookRepository $bookRepository
     * @param ApiResponse $apiResponse
     */
    public function __construct(BookRepository $bookRepository, ApiResponse $apiResponse)
    {
        $this->bookRepository = $bookRepository;
        $this->apiResponse = $apiResponse;
    }

    /**
     * @group Book management
     *
     *  Book Collection
     *
     * An Endpoint to get all Book in the system
     *
     * @param Book $books
     * @return \Illuminate\Http\JsonResponse
     * @apiResourceCollection \App\Http\Resources\v1\Book\BookResourceCollection
     * @apiResourceModel \App\Models\Book
     */
    public function index()
    {
        return $this->apiResponse->respondWithNoPagination(
            new BookResourceCollection($this->bookRepository->getAllBooks())
        );
    }


    /**
     * @group Book management
     *
     *  Books Collection
     *
     * An Endpoint to get all Books in the system
     *
     * @param CreateBookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * @apiResourceCollection \App\Http\Resources\v1\Book\BookResourceCollection
     * @apiResourceModel \App\Models\Book
     */
    public function store(CreateBookRequest $request, Book $book)
    {
        $book = $book->create($request->toArray());
        return $this->apiResponse->respondWithNoPagination($book,
            'Book created successfully');
    }


    /**
     * @group Book management
     *
     *  Books Collection
     *
     * An Endpoint to get all Books in the system
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * @apiResourceCollection \App\Http\Resources\v1\Book\BookResourceCollection
     * @apiResourceModel \App\Models\Book
     */
    public function show(Book $book)
    {
        return $this->apiResponse->respondWithNoPagination($book, 'Book fetch successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UpdateBookRequest $request
     * @return void
     */
    public function update(UpdateBookRequest $request, $id)
    {
         $updatedBook = $this->bookRepository->updateUser($request, $id);
         if(is_string($updatedBook)) return $this->apiResponse->respondWithError($updatedBook);
        return $this->apiResponse->respondWithNoPagination($updatedBook,
            "The book $updatedBook->name was updated successfully");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return void
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->apiResponse->respondDeleted("The book $book->name was deleted successfully");
    }


    /**
     * Get a book from external storage.
     *
     * @param Request $request
     * @return void
     */
    public function externalBook(Request $request)
    {
        $bookName = $request->name;
        //checking if the book was supplied
        if (empty($bookName)) return $this->apiResponse->respondWithError('Invalid Book name supplied');
       //finding the book
        $bookCollection = $this->bookRepository->findBookByName($bookName);
       //checking if it throws error
        if (is_string($bookCollection)) return $this->apiResponse->respondWithError('Error fetching the book from the api');
        //returning the final data
        return $this->apiResponse->respondWithNoPagination(new ExternalBookResourceCollection($bookCollection));
    }

}
