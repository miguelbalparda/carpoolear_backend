<?php

use Mockery as m;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FriendApiTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    protected $friendsLogic;

    public function __construct()
    {
    }

    public function setUp()
    {
        parent::setUp();
        $this->friendsLogic = $this->mock('STS\Contracts\Logic\Friends');
    }

    public function tearDown()
    {
        m::close();
    }

    protected function parseJson($response)
    {
        return json_decode($response->getContent());
    }

    public function testRequest()
    {
        $u1 = factory(STS\User::class)->create();
        $u2 = factory(STS\User::class)->create();
        $this->actingAsApiUser($u1);

        $this->friendsLogic->shouldReceive('request')->once()->andReturn(true);

        $response = $this->call('POST', 'api/friends/request/'.$u2->id);
        $this->assertTrue($response->status() == 200);
    }

    public function testAccept()
    {
        $u1 = factory(STS\User::class)->create();
        $u2 = factory(STS\User::class)->create();
        $this->actingAsApiUser($u1);

        $this->friendsLogic->shouldReceive('accept')->once()->andReturn(true);

        $response = $this->call('POST', 'api/friends/accept/'.$u2->id);
        $this->assertTrue($response->status() == 200);
    }

    public function testReject()
    {
        $u1 = factory(STS\User::class)->create();
        $u2 = factory(STS\User::class)->create();
        $this->actingAsApiUser($u1);

        $this->friendsLogic->shouldReceive('reject')->once()->andReturn(true);

        $response = $this->call('POST', 'api/friends/reject/'.$u2->id);
        $this->assertTrue($response->status() == 200);
    }

    public function testDelete()
    {
        $u1 = factory(STS\User::class)->create();
        $u2 = factory(STS\User::class)->create();
        $this->actingAsApiUser($u1);

        $this->friendsLogic->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('POST', 'api/friends/delete/'.$u2->id);
        $this->assertTrue($response->status() == 200);
    }

    public function testIndex()
    {
        $u1 = factory(STS\User::class)->create();
        $u2 = factory(STS\User::class)->create();
        $this->actingAsApiUser($u1);

        $this->friendsLogic->shouldReceive('getFriends')->once()->andReturn(STS\User::all());

        $response = $this->call('GET', 'api/friends/');
        $this->assertTrue($response->status() == 200);
        $friends = $this->parseJson($response);

        $this->assertTrue($friends->data[0]->id == $u1->id);
    }

    public function testPendings()
    {
        $u1 = factory(STS\User::class)->create();
        $u2 = factory(STS\User::class)->create();
        $this->actingAsApiUser($u1);

        $this->friendsLogic->shouldReceive('getPendings')->once()->andReturn(STS\User::all());

        $response = $this->call('GET', 'api/friends/pedings');
        $this->assertTrue($response->status() == 200);
        $friends = $this->parseJson($response);

        $this->assertTrue(count($friends->data) == 2);
    }
}
