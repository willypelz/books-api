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
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
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
    public function it_returns_No_content_when_content_is_deleted()
    {

        $response = $this->deleteJson('/api/v1/books/' . $this->book->id);
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_NO_CONTENT]);
    }
}
