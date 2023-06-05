<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;

        Storage::fake(env('DEFAULT_MEDIA_DISC')); // Use the 'public' disk for testing

        $file = UploadedFile::fake()->image(time().'.jpg');
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('post', '/api/post',[
                'title'=>'Test title',
                'content'=>'Test content',
                'image'=>$file,
                'author_id'=>$user->id,
            ]);

        $response->assertStatus(200);

    }
}
