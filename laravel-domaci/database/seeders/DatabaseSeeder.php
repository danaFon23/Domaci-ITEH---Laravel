<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        
        //User::truncate();
        Country::truncate();
        Genre::truncate();
        Director::truncate();
        Movie::truncate();
       
        $director1 = Director::factory()->create();
        $director2 = Director::factory()->create();
        $director3 = Director::factory()->create();

        $genre1 = Genre::factory()->create();
        $genre2 = Genre::factory()->create();
        $genre3 = Genre::factory()->create();

        Movie::factory(5)->create([
            'director_id'=>$director1->id,
            'genre_id'=>$genre1->id,
        ]);

        Movie::factory(2)->create([
            'director_id'=>$director2->id,
            'genre_id'=>$genre2->id,
        ]);

        Movie::factory(3)->create([
            'director_id'=>$director3->id,
            'genre_id'=>$genre3->id,
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
