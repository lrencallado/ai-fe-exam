<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'writer@example.com',
            'password' => Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'type' => \App\Enums\Type::WRITER,
            'status' => \App\Enums\Status::ACTIVE,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Dela Cruz',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'type' => \App\Enums\Type::EDITOR,
            'status' => \App\Enums\Status::ACTIVE,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory()
            ->count(10)
            ->create();
    }
}
