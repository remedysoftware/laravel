<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Topic;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->count(10)->create()->each(function ($u) {
            for ($i=0; $i <= 3; $i++) {
              $u->posts()->save(factory(Topic::class)->make());
            }  
          });
    }
}
