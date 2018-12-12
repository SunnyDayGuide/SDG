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
                'name' => 'Meredith',
                'email' => 'meredith@sdg.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Indiana Jones',
                'email' => 'indy@example.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Ben Solo',
                'email' => 'kylo@example.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Marty McFly',
                'email' => 'calvin@example.com',
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
