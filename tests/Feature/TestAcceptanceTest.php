<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestAcceptanceTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->Test = factory(App\Models\Test::class)->make([
            // Test table data
        ]);
        $this->TestEdited = factory(App\Models\Test::class)->make([
            // Test table data
        ]);
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'tests');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('tests');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'tests/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'tests', $this->Test->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('tests/'.$this->Test->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'tests', $this->Test->toArray());

        $response = $this->actor->call('GET', '/tests/'.$this->Test->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('test');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'tests', $this->Test->toArray());
        $response = $this->actor->call('PATCH', 'tests/1', $this->TestEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('tests', $this->TestEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'tests', $this->Test->toArray());

        $response = $this->call('DELETE', 'tests/'.$this->Test->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('tests');
    }

}
