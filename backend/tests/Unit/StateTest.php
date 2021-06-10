<?php

namespace Tests\Unit;

use App\Model\State;
use Tests\TestCase;
use Faker\Factory as Faker;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Response;

class StateTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function test_main_page_works()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_state_api_structure()
    {
        $this->json('get', '/api/v1/state')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    '*' => [
                        'id',
                        'name'
                    ]
                ]
            );
    }

    public function test_for_all_states()
    {
        $states = State::distinct()->get();

        $this->json('get', '/api/v1/state')
            ->assertStatus(Response::HTTP_OK)
            ->assertSuccessful()
            ->assertJsonStructure(
                [
                    '*' => [
                        'id',
                        'name'
                    ]
                ]
            )
            ->assertJsonCount($states->count());
    }

    public function test_for_search_state()
    {
        $faker = Faker::create();
        $name = $faker->name;
        State::create(['name'=>$name]);
        $url = '/api/v1/state/search?term=' . $name;
        $response = $this->get($url);
        $response->assertStatus(200);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('states', [
            'name' => $name
        ]);
    }

    public function test_for_invalid_search_state()
    {
        $faker = Faker::create();
        $name = $faker->name;
        $url = '/api/v1/state/search?term=' . $name;
        $response =$this->get($url);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([], json_decode($response->getContent(), true));
        $this->assertEquals([], json_decode($response->getContent(), true));

    }
}
