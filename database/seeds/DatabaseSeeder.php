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
        if (config('app.env') == 'local') {

            $this->call([
                RoomsTableSeeder::class,
                UsersTableSeeder::class,
            ]);

        } else {

            $this->call([
                AdministratorSeeder::class,
            ]);

        }
    }
}
