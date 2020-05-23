<?php

use Illuminate\Database\Seeder;
use App\Models\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        Users::unguard();
        factory(Users::class, 5)->create();
        Users::reguard();
    }
}
