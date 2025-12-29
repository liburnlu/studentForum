<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;
use Database\Factories\TopicFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create();
        Category::factory(10)->create();
        Topic::factory(20)->create();
        Reply::factory(40)->create();

    }
}
