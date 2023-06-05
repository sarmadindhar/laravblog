<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = $this->faker->image('public/storage/public', 400, 300, null, false);

        return [
            'title'=>$this->faker->realText(50),
            'content'=>$this->faker->realText,
            'author_id'=>User::inRandomOrder()->first()->id,
            'image'=>'public/'.$image,
        ];
    }
}
