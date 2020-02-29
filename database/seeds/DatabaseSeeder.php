<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        User::create([
                                     'name'   => 'mohammad abdi',
                                     'mobile' => '09352864812',
                                     'email'  => 'mohammad_m69@yahoo.com',
                                     'password'  => Hash::make(123456),
                                 ]);
        User::create([
                                     'name'   => 'ali rezayi',
                                     'email'  => 'ali@yahoo.com',
                                     'password'  => Hash::make(123456),
                                 ]);
        User::create([
                                     'name'   => 'hasan ahmadi',
                                     'email'  => 'hasan@yahoo.com',
                                     'password'  => Hash::make(123456),
                                 ]);
    }

}
