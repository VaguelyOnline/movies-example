<?php

namespace Tests\Feature;

use App\Models\Actor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_auth_can_create_a_fan()
    {
        $this->postJson('/api/fans')->assertUnauthorized();

        $user = new User([
            'id' => 1
        ]);
        $this->actingAs($user)->postJson('/api/fans')->assertUnprocessable();

        $this->actingAs($user)->postJson('/api/fans', [
            'actor_id' => -1
        ])->assertUnprocessable();

        $this->actingAs($user)->postJson('/api/fans', [
            'actor_id' => 1
        ])->assertCreated();
    }
}
