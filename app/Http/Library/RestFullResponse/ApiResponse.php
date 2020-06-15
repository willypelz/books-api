<?php

/************************************
 ** File: ApiResponse  file  ******
 ** Date: 9th June 2020  ************
 ** Api Response File  ************
 ** Author: Asefon pelumi M. *********
 ** Senior Software Developer ********
 * Email: pelumiasefon@gmail.com  ***
 * **********************************/

namespace App\Http\Library\RestFullResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use App\Http\Controllers\Controller;
use Response;


class ApiResponse extends Controller
{

    protected $statusCode = IlluminateResponse::HTTP_OK;

    /** status code getter
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /** status code setter
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError([
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError([
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondBadRequest($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError([
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }


    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => $message
        ]);

    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondDeleted($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respond([
            'status_code' => IlluminateResponse::HTTP_NO_CONTENT,
            'status' => 'success',
            'message' => $message,
            'data' => []
        ]);
    }


    /**
     * @param $data
     * @param $message
     * @return mixed
     */
    public function respondWithNoPagination($data, $message = 'Data fetched Successful')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respond([
            'status_code' => $this->getStatusCode(),
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @return mixed
     */
    public function respondWithDataStatusAndCodeOnly($data, $statusCode = IlluminateResponse::HTTP_OK)
    {
        return $this->setStatusCode($statusCode)->respond([
            'status_code' => $this->getStatusCode(),
            'status' => 'success',
            'data' => $data
        ]);
    }


    /**
     * @param $books
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination($books, $data)
    {

        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $books->total(),
                'total_pages' => ceil($books->total() / $books->perPage()),
                'current_page' => $books->currentPage(),
                'limit' => $books->Perpage(),
                'hasMorePages' => $books->hasMorePages(),
                'nextPageUrl' => $books->nextPageUrl(),
                'lastPage' => $books->lastPage(),
                'previousPageUrl' => $books->previousPageUrl(),
                'getUrlRange' => $books->getUrlRange(),
                'url' => $books->url()
            ]
        ]);

        return $this->respond($data);

    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return array
     */
    function getErrorMessages(\Illuminate\Contracts\Validation\Validator $validator){
        $messages =  $validator->errors()->getMessages();
        $replaced = str_replace(['[',']', '"', '.','id'], '', json_encode(array_values($messages)));
        return explode(',',$replaced);
    }



}
