<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('admin123')
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin2@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('admin123')
        ]);
    }
}
