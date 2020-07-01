<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_creating_a_book()
    {
        $data = [
            'name' => 'Asefon',
            'isbn' => '123-234-ael',
            'authors' => 'williams Michael, Asefon Pelumi',
            'number_of_pages' => 25,
            'publisher' => 'pelumiasefon@gmail.com',
            'country' => 'Nigeria',
            'release_date' => '2020-06-09',

        ];

        $response = $this->postJson('/api/v1/books', $data);
        $response->assertStatus(JsonResponse::HTTP_CREATED)
            ->assertJson(["status_code" => JsonResponse::HTTP_CREATED]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_getting_all_books()
    {

        $response = $this->getJson('/api/v1/books');
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_getting_filtered_books()
    {

        $response = $this->getJson('/api/v1/books?name=Asefon');
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_error_when_getting_filtered_books()
    {

        $response = $this->getJson('/api/v1/books?wrongKey=Asefon');
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["error" => "invalid search key supplied"]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_single_book_when_is_fetched()
    {

        $response = $this->getJson('/api/v1/books/' . $this->book->id);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_success_when_book_was_updated()
    {
        $data = [
            'name' => 'Asefon',
            'isbn' => '123-234-ael',
            'authors' => 'williams Michael, Asefon Pelumi',
            'number_of_pages' => 25,
            'publisher' => 'pelumiasefon@gmail.com',
            'country' => 'Nigeria',
            'release_date' => '2020-06-09',

        ];

        $response = $this->patchJson('/api/v1/books/' . $this->book->id, $data);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_error_when_book_was_updated()
    {
        $data = [
            'name' => 'Asefon',
            'isbn' => '123-234-ael',
            'authors' => 'williams Michael, Asefon Pelumi',
            'number_of_pages' => 25,
            'publisher' => 'pelumiasefon@gmail.com',
            'country' => 'Nigeria',
            'release_date' => '2020-06-09',

        ];

        $response = $this->patchJson('/api/v1/books/' . 40, $data);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["error" => "Book to be updated not found"]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_No_content_when_content_is_deleted()
    {

        $response = $this->deleteJson('/api/v1/books/' . $this->book->id);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_NO_CONTENT]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_return_Invalid_when_content_is_deleted()
    {

        $response = $this->getJson('/api/v1/external-books');
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([
                "error" => "Invalid Book name supplied"
            ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_error_when_wrong_data_is_supplied()
    {

        $response = $this->getJson('/api/v1/external-books/?name=' . "Wrong title of Kings");
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_returns_correct_from_External_api()
    {
        $query = "A Clash of Kings";
        $response = $this->getJson("/api/v1/external-books/?name=$query");
        $response->assertStatus(JsonResponse::HTTP_OK);

    }


}
