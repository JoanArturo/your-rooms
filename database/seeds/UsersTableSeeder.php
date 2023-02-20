<?php

use App\Message;
use App\Room;
use App\Suggestion;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@yourooms.com',
            'is_admin' => true
        ]);

        factory(User::class, 100)->create()->each(function($user) {
            $user->messages()->createMany(
                factory(Message::class, 10)->make()->toArray()
            );

            $user->rooms()->attach(
                Room::selectRaw('id as room_id')->get()->random(5)->toArray()
            );

            $user->suggestions()->createMany(
                factory(Suggestion::class, 5)->make()->toArray()
            );
        });
    }
}
