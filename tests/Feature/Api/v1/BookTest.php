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
    public function it_returns_success_when_correct_book_data_is_supplied_for_registration()
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
    public function it_returns_succesddds_when_correct_book_data_is_supplied_for_registration()
    {

        $response = $this->getJson('/api/v1/books');
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(["status_code" => JsonResponse::HTTP_OK]);
    }

//    /**
//     * A basic feature test example.
//     *
//     * @return void
//     */
//    /** @test */
//    public function it_returns_succedsddds_when_correct_book_data_is_supplied_for_registration()
//    {
//
////        $response = $this->getJson('/api/v1/books/101');
////        $response->assertStatus(JsonResponse::HTTP_NOT_FOUND)
////            ->assertJson(["status_code" => JsonResponse::HTTP_NOT_FOUND]);
//    }
}
