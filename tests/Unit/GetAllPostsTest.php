<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;



class GetAllPostsTest extends TestCase
{


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_getAll()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/post');
        $response->assertStatus(200);
    }
}
