<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\JsonResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $book;

    /**
     *
     * factory model connection for testing
     */
    public function setUp(): void
    {
        parent::setUp();
        /**
         * This disables the exception handling to display the stacktrace on the console
         * the same way as it shown on the browser
         */
        $this->disableExceptionHandling();

        \Artisan::call('migrate');

        $books = factory(\App\Models\Book::class)->times(3)->create();
        $this->book = $books[0];


    }

    protected function disableExceptionHandling()
    {

    }

    }
