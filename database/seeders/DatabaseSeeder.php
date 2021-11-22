<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        $user = User::create([
            'name'=>'User',
            'email'=>'user@user.com',
            'password' => Hash::make('password')
        ]);
        $user->todos()->saveMany(Todo::factory( 10)->make());
         \App\Models\User::factory(10)->create()->each(function ($u){
             $u->todos()
                 ->saveMany(Todo::factory( random_int(3,7))->make());
         });
    }
}
