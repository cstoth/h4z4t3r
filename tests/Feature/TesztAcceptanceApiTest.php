<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TesztAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->Teszt = factory(App\Models\Teszt::class)->make([
            // Teszt table data
        ]);
        $this->TesztEdited = factory(App\Models\Teszt::class)->make([
            // Teszt table data
        ]);
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/teszts');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/teszts', $this->Teszt->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/teszts', $this->Teszt->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/teszts/1', $this->TesztEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('teszts', $this->TesztEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/teszts', $this->Teszt->toArray());
        $response = $this->call('DELETE', 'api/v1/teszts/'.$this->Teszt->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'teszt was deleted']);
    }

}
