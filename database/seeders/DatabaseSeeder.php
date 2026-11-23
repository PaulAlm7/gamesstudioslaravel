<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@games.pt'],
            [
                'name' => 'Admin Estúdios',
                'password' => Hash::make('password123'),
                'user_type' => User::TYPE_ADMIN,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@games.pt'],
            [
                'name' => 'Utilizador Editor',
                'password' => Hash::make('password123'),
                'user_type' => User::TYPE_GENERIC_USER,
            ]
        );

        $studio1 = Studio::firstOrCreate(['name' => 'FromSoftware'], ['photo' => null]);
        $studio2 = Studio::firstOrCreate(['name' => 'Naughty Dog'], ['photo' => null]);
        $studio3 = Studio::firstOrCreate(['name' => 'Grinding Gear Games'], ['photo' => null]);

        Game::firstOrCreate(
            ['studio_id' => $studio1->id, 'name' => 'Elden Ring'],
            ['cover' => null, 'release_date' => '2022-02-25']
        );

        Game::firstOrCreate(
            ['studio_id' => $studio1->id, 'name' => 'Dark Souls III'],
            ['cover' => null, 'release_date' => '2016-03-24']
        );

        Game::firstOrCreate(
            ['studio_id' => $studio2->id, 'name' => 'The Last of Us Part I'],
            ['cover' => null, 'release_date' => '2022-09-02']
        );

        Game::firstOrCreate(
            ['studio_id' => $studio3->id, 'name' => 'Path of Exile'],
            ['cover' => null, 'release_date' => '2013-10-23']
        );

        Game::firstOrCreate(
            ['studio_id' => $studio3->id, 'name' => 'Path of Exile 2'],
            ['cover' => null, 'release_date' => '2024-12-06']
        );
    }
}
