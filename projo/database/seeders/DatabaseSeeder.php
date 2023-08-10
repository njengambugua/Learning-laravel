<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Faker\Provider\Lorem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'John'
        ]);
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
    }
}
