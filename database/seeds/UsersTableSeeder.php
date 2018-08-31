<?php

use App\Models\User;
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
        User::create([
            'firstname' => 'Son',
            'lastname' => 'Dang',
            'login_name' => 'dtscit12i4',
            'password' => 'secret', // secret
            'role' => 1,
            'deleted_at_by' => 0
        ]);

        User::create([
            'firstname' => 'Vu',
            'lastname' => 'Dang',
            'login_name' => 'vudang',
            'password' => 'secret', // secret
            'role' => 1,
            'deleted_at_by' => 0
        ]);

        User::create([
            'firstname' => 'Truong',
            'lastname' => 'Dang',
            'login_name' => 'truongdang',
            'password' => 'secret', // secret
            'role' => 1,
            'deleted_at_by' => 0
        ]);

        User::create([
            'firstname' => 'Huy',
            'lastname' => 'Truong',
            'login_name' => 'huytruong',
            'password' => 'secret', // secret
            'role' => 1,
            'deleted_at_by' => 0
        ]);

        User::create([
            'firstname' => 'Nhu',
            'lastname' => 'Tran',
            'login_name' => 'nhutran',
            'password' => 'secret', // secret
            'role' => 0,
            'deleted_at_by' => 0
        ]);
    }
}
