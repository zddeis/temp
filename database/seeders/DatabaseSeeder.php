<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User_Type;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\note;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed User Types

        User_Type::factory()->create([
            "type" => "Regular"
        ]);
        
        User_Type::factory()->create([
            "type" => "Admin"
        ]);

        // Seed Users

        User::factory()->create([
            "name" => "Admin",
            "email" => "david.fcg07@gmail.com",
            "type" => 2
        ]);

        User::factory()->create([
            "name" => "User",
            "email" => "Tiago@gmail.com"
        ]);

        // Seed Notes

        Note::factory()->create([
            "title" => "First Note",
            "body" => "Body #1"
        ]);
        
        Note::factory()->create([
            "title" => "Second Note",
            "body" => "Body #2"
        ]);
    }
}
