<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TesztAcceptanceTest extends TestCase
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
        $response = $this->actor->call('GET', 'teszts');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('teszts');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'teszts/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'teszts', $this->Teszt->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('teszts/'.$this->Teszt->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'teszts', $this->Teszt->toArray());

        $response = $this->actor->call('GET', '/teszts/'.$this->Teszt->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('teszt');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'teszts', $this->Teszt->toArray());
        $response = $this->actor->call('PATCH', 'teszts/1', $this->TesztEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('teszts', $this->TesztEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'teszts', $this->Teszt->toArray());

        $response = $this->call('DELETE', 'teszts/'.$this->Teszt->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('teszts');
    }

}
