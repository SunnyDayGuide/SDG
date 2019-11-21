<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        collect([
            [
                'name' => 'Meredith Byrum',
                'email' => 'meredith@sunnydayguide.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Scott Maccubbin',
                'email' => 'scott@sunnydayguide.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Jill Prescott',
                'email' => 'jill@sunnydayguide.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Nick Henney',
                'email' => 'nick@sunnydayguide.com',
                'password' => bcrypt('password')
            ],
        ])->each(function ($user) {
            factory(User::class)->create(
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt('password')
                ]
            );
        });
    }
}
