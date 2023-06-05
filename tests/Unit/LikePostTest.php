<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LikePostTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_like()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $post = Post::inRandomOrder()->first();
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('post', '/api/posts/like/'.$post->id);
        $response->assertStatus(200);

    }
}
