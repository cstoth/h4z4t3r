<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestAcceptanceApiTest extends TestCase
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
        $response = $this->actor->call('GET', 'api/v1/tests');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/tests', $this->Test->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/tests', $this->Test->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/tests/1', $this->TestEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('tests', $this->TestEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/tests', $this->Test->toArray());
        $response = $this->call('DELETE', 'api/v1/tests/'.$this->Test->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'test was deleted']);
    }

}
