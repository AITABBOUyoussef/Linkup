<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\Models\User;

class registerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user=User::factory()->create();
        $response = $this->actingAs($user)->get('/feed');

        $response->assertStatus(200);
    }
}
