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
use App\Http\Resources\v1\Books\SingleBookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    protected $bookRepository;
    protected $apiResponse;
    protected $bookResource;


    /**
     * BooksController constructor.
     * @param BookRepository $bookRepository
     * @param ApiResponse $apiResponse
     * @param BookResource $bookResource
     */
    public function __construct(
        BookRepository $bookRepository,
        ApiResponse $apiResponse,
        BookResource $bookResource
    )
    {
        $this->bookRepository = $bookRepository;
        $this->apiResponse = $apiResponse;
        $this->bookResource = $bookResource;
    }

    /**
     * @group Book management
     *
     *  Book Collection
     *
     * An Endpoint to get all Book in the system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @apiResourceCollection \App\Http\Resources\v1\Book\BookResourceCollection
     * @apiResourceModel \App\Models\Book
     */
    public function index(Request $request)
    {

        if ($request->all()) {
            $books = $this->bookRepository->searchBookTable($request->all());
            if (is_string($books)) return $this->apiResponse->respondWithError($books);
        } else {
            $books = $this->bookRepository->getAllBooks();
        }
        return $this->apiResponse->respondWithDataStatusAndCodeOnly(
            $this->bookResource->transformCollection($books->toArray()), JsonResponse::HTTP_OK);
    }


    /**
     * @group Book management
     *
     *  Books Collection
     *
     * An Endpoint to store book in the system
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
        $book['hide_id'] = true;
        return $this->apiResponse->respondWithDataStatusAndCodeOnly(
            ['book' => $this->bookResource->transform($book)], JsonResponse::HTTP_CREATED);
    }


    /**
     * @group Book management
     *
     *  Books Collection
     *
     * An Endpoint to get single Book detail in the system
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * @apiResourceCollection \App\Http\Resources\v1\Book\BookResourceCollection
     * @apiResourceModel \App\Models\Book
     */
    public function show(Book $book)
    {
        return $this->apiResponse->respondWithDataStatusAndCodeOnly(
            $this->bookResource->transform($book));
    }

    /**
     * An Endpoint to update the specified resource from storage.
     *
     * @param UpdateBookRequest $request
     * @return void
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $updatedBook = $this->bookRepository->updateBook($request, $id);
        if (is_string($updatedBook)) return $this->apiResponse->respondWithError($updatedBook);

        return $this->apiResponse->respondWithNoPagination(
            $this->bookResource->transform($updatedBook),
            "The book $updatedBook->name was updated successfully");
    }


    /**
     * An Endpoint to Remove the specified resource from storage.
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
     * An Endpoint to Get a book from external storage.
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
        return $this->apiResponse->respondWithDataStatusAndCodeOnly(new ExternalBookResourceCollection($bookCollection));
    }

}
