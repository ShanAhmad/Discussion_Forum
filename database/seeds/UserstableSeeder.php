<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'admin',
            'password'=>bcrypt('admin'),
            'email'=>'abc@forum.com',
            'admin'=>1,
            'avatar'=>asset('avatar/avatar.png')
        ]);
        App\User::create([
            'name'=>'umer',
            'password'=>bcrypt('umer1234'),
            'email'=>'umer@dev.com',
            'avatar'=>asset('avatar/avatar.png')
        ]);
    }
}
