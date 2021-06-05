<?php

namespace Tests\Feature;

use App\Model\State;
use Tests\TestCase;
use Faker\Factory as Faker;
use GuzzleHttp\Client as GuzzleClient;

class StateTest extends TestCase
{
    private $client;
    private $endpoint;

    public function __construct()
    {
        parent::__construct();
        $this->client = new GuzzleClient();
        $this->endpoint = 'http://192.168.0.105:' . env('BACKEND_PORT', '8083');
    }

    /**
     * @return void
     */
    public function test_main_page_works()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_for_all_states()
    {
        $url = $this->endpoint . '/api/v1/state';
        $res = $this->client->request('GET', $url);
        $this->assertEquals(200, $res->getStatusCode());

    }

    /**
     * @return void
     */
    public function test_for_search_state()
    {
        $faker = Faker::create();
        $name = $faker->name;

        State::create(['name'=>$name]);

        $url = $this->endpoint . '/api/v1/state/search?term=' . $name;
        $res = $this->client->request('GET', $url);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertDatabaseHas('states', [
            'name' => $name
        ]);
    }

    /**
     * @return void
     */
    public function test_for_invalid_search_state()
    {
        $faker = Faker::create();
        $name = $faker->name;

        $url = $this->endpoint . '/api/v1/state/search?term=' . $name;
        $res = $this->client->request('GET', $url);

        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals([], json_decode($res->getBody(), true));
    }
}
