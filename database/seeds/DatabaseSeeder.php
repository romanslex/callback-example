<?php

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
        // $this->call(UsersTableSeeder::class);
        factory(\App\Models\User::class)
            ->create(["email" => "admin@callback.mail", "name" => "Admin"])
            ->each(function($user){
                $user->widgets()->save(
                    factory(\App\Models\Widget::class)->make([
                        "url" => "example.com"
                    ]));
            });
    }
}
