<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;


class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminDT = User::where('email', 'admin@appringer.com')->first();
        if($adminDT === null){
            User::create([
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@appringer.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin@123'), // admin@123
                'remember_token' => Str::random(10),
                'status' => 1,
            ]);
        }else{
            User::where('email', 'admin@appringer.com')->update([
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@appringer.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin@123'), // admin@123
                'remember_token' => Str::random(10),
                'status' => 1,
            ]);
        }
    }
}
