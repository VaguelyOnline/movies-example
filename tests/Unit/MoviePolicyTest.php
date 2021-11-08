<?php

namespace Tests\Unit;

use App\Models\User;
use App\Policies\MoviePolicy;
use PHPUnit\Framework\TestCase;

class MoviePolicyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_admin_can_create()
    {
        $policy = new MoviePolicy();
        $user = User::find(1);

        $canCreate = $policy->create($user);
        $this->assertTrue($canCreate);
    }

    public function test_non_admin_cannot_create()
    {
        $policy = new MoviePolicy();
        $user = new User([
            'id' => 2
        ]);
        echo $user->id;

        $canCreate = $policy->create($user);
        $this->assertFalse($canCreate);
    }
}
