<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = DB::select('SELECT * FROM users');
       $num = count($users);
       if($num == 0)
       {
           DB::table('users')->insert([
               'name'=>'Admin',
               'email'=>'admin@admin.com',
               'password'=>bcrypt(Str::random(10))
           ]);
       }
       else
       {
            DB::table('users')->insert([
            'name'=>Str::random(10),
            'email'=>Str::random(10),
            'password'=>bcrypt(Str::random(10))
        ]);
       }
    }
}
